<?php
/* FICHIER : index.php (Complet et Corrigé) */
session_start();
require_once 'config/db.php';

// Récupération des matchs
// Jointure pour avoir le Nom de la Ville (v.nom_ville)
$sql = "SELECT m.*, 
               e1.nom_equipe AS equipe1, e1.pays AS pays1,
               e2.nom_equipe AS equipe2, e2.pays AS pays2,
               s.nom_stade, 
               v.nom_ville
        FROM matchs m
        JOIN equipes e1 ON m.id_equipe1 = e1.id_equipe
        JOIN equipes e2 ON m.id_equipe2 = e2.id_equipe
        JOIN stades s ON m.id_stade = s.id_stade
        JOIN villes v ON s.id_ville = v.id_ville
        ORDER BY m.date_match ASC, m.heure_match ASC";

try {
    $stmt = $pdo->query($sql);
    $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $matches = [];
    $error_msg = "Erreur SQL : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAN 2026 - Plateforme Officielle Maroc</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --maroc-vert: #064e3b; --maroc-vert-light: #0d7a5d; --maroc-rouge: #991b1b; --gold: #d4af37; }
        body { font-family: 'Poppins', sans-serif; margin: 0; background-color: #f3f4f6; color: #111827; background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); }
        nav { background: linear-gradient(90deg, var(--maroc-vert) 0%, var(--maroc-vert-light) 100%); color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; border-bottom: 3px solid var(--gold); }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; padding: 8px 12px; border-radius: 5px; transition: 0.3s; }
        .nav-links a:hover { background: rgba(255,255,255,0.1); color: var(--gold); }
        .btn-nav { background: var(--maroc-rouge); }
        .hero { background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000'); background-size: cover; color: white; padding: 100px 20px; text-align: center; clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%); }
        .search-box { max-width: 600px; margin: -30px auto 40px; position: relative; z-index: 10; }
        .search-box input { width: 100%; padding: 20px 30px; border-radius: 50px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-size: 1.1rem; outline: none; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; margin-top: 20px; }
        .match-card { background: rgba(255, 255, 255, 0.95); border-radius: 18px; padding: 25px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); border-top: 5px solid var(--maroc-vert); transition: 0.4s; position: relative; overflow: hidden; }
        .match-card:hover { transform: translateY(-10px); border-top-color: var(--maroc-rouge); }
        .match-time { color: var(--maroc-rouge); font-weight: 800; font-size: 1.1rem; display: block; margin-bottom: 8px; }
        .match-teams { font-size: 1.3rem; font-weight: 800; margin-bottom: 12px; color: #1f2937; }
        .match-stadium { font-size: 0.9rem; color: #6b7280; margin-bottom: 20px; min-height: 45px; display: flex; align-items: center; gap: 5px; }
        .price-tag { display: block; color: var(--maroc-vert); font-weight: 800; font-size: 1.2rem; margin-bottom: 15px; border-top: 2px dashed #eee; padding-top: 15px; }
        .btn { background: linear-gradient(135deg, var(--maroc-rouge) 0%, #7f1d1d 100%); color: white; border: none; padding: 14px; border-radius: 10px; cursor: pointer; font-weight: bold; width: 100%; text-transform: uppercase; text-decoration: none; display:block; text-align:center; }
        .btn:hover { filter: brightness(1.2); }
        .date-badge { background: linear-gradient(135deg, #10b981, #059669); padding: 5px 15px; border-radius: 20px; color: white; font-size: 0.8rem; font-weight: bold; position: absolute; top: 15px; right: 15px; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026 <span style="color:var(--gold)">MAROC</span></div>
    <div class="nav-links">
        <a href="index.php">Calendrier</a>
        <a href="services.php">Transport</a>
        
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <a href="admin/matches.php" class="btn-nav">Admin Panel</a>
            <?php else: ?>
                <span style="color:var(--gold); font-weight:bold; margin-left:15px;">
                    👤 <?= htmlspecialchars($_SESSION['username']) ?>
                </span>
            <?php endif; ?>
            <a href="logout.php" style="color:#ffcccc;">Déco</a>
        <?php else: ?>
            <a href="login.php" class="btn-nav">Connexion</a>
        <?php endif; ?>
    </div>
</nav>

<div class="hero">
    <h1>BILLETTERIE OFFICIELLE</h1>
    <p>Réservez vos places pour la plus grande fête du football africain</p>
</div>

<div class="container">
    <div class="search-box">
        <input type="text" id="searchInput" onkeyup="searchMatch()" placeholder="Rechercher une équipe (ex: Maroc)...">
    </div>

    <?php if (isset($error_msg)): ?>
        <p style="color:red; text-align:center; font-weight:bold;"><?= $error_msg ?></p>
    <?php endif; ?>

    <?php if (count($matches) === 0): ?>
        <p style="text-align:center; padding: 50px;">Aucun match programmé pour l'instant.</p>
    <?php else: ?>
        
        <div class="grid" id="matchesContainer">
            <?php foreach ($matches as $match): ?>
            
            <div class="match-card">
                <div class="date-badge">
                    <?= date('d/m/Y', strtotime($match['date_match'])) ?>
                </div>
                <span class="match-time">
                    🕗 <?= date('H:i', strtotime($match['heure_match'])) ?>
                </span>
                
                <div class="match-teams">
                    <?= htmlspecialchars($match['equipe1']) ?> 
                    <span style="color:#ccc; font-size:0.8em">vs</span> 
                    <?= htmlspecialchars($match['equipe2']) ?>
                </div>

                <div class="match-stadium">
                    📍 <?= htmlspecialchars($match['nom_stade']) ?> - <?= htmlspecialchars($match['nom_ville']) ?>
                </div>
                
                <span class="price-tag">
                    <?= htmlspecialchars($match['prix']) ?> DH
                </span>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="reservation.php?id=<?= $match['id_match'] ?>" class="btn">Réserver Billet</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Se connecter pour réserver</a>
                <?php endif; ?>
            </div>

            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</div>

<footer style="text-align:center; padding:40px; background:#111; color:white; margin-top:50px;">
    <p>&copy; 2026 Comité d'Organisation CAN Maroc</p>
</footer>

<script>
    function searchMatch() {
        let input = document.getElementById('searchInput').value.toUpperCase();
        let cards = document.getElementsByClassName('match-card');
        for (let i = 0; i < cards.length; i++) {
            let teams = cards[i].getElementsByClassName('match-teams')[0].innerText;
            if (teams.toUpperCase().indexOf(input) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>