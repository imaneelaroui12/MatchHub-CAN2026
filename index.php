<?php
/* FICHIER : index.php (VERSION ULTIME : Image + Recherche + Vraie BDD) */
session_start();
require_once 'config/db.php';

// Requête SQL adaptée à la nouvelle structure (Vraies équipes, vrais stades)
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
    <title>CAN 2026 - Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        /* --- CSS GLOBAL --- */
        :root { --maroc-vert: #064e3b; --maroc-rouge: #991b1b; --gold: #d4af37; }
        body { font-family: 'Poppins', sans-serif; margin: 0; background-color: #f3f4f6; background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); }
        
        /* NAVBAR */
        nav { background: linear-gradient(90deg, #064e3b 0%, #0d7a5d 100%); color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid var(--gold); position: sticky; top: 0; z-index: 1000; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; }
        .nav-links a:hover { color: var(--gold); }

        /* HERO SECTION (IMAGE DE FOND) */
        .hero { 
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000'); 
            background-size: cover; 
            background-position: center;
            color: white; 
            padding: 100px 20px; 
            text-align: center; 
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        /* BARRE DE RECHERCHE (AJOUTÉE ICI) */
        .search-box { max-width: 600px; margin: -30px auto 40px; position: relative; z-index: 10; text-align: center; }
        .search-box input { width: 100%; padding: 20px 30px; border-radius: 50px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-size: 1.1rem; outline: none; }

        /* GRILLE ET CARTES */
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; margin-top: 20px; }
        .match-card { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-top: 5px solid var(--maroc-vert); position:relative; transition: transform 0.3s; }
        .match-card:hover { transform: translateY(-5px); }
        .match-teams { font-size: 1.2rem; font-weight: 800; color: #333; margin: 10px 0; }
        .btn { background: var(--maroc-rouge); color: white; display: block; text-align: center; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-top: 15px; transition: 0.3s; }
        .btn:hover { background: #7f1d1d; }
        .date-badge { position: absolute; top: 15px; right: 15px; background: #dcfce7; color: #166534; padding: 5px 10px; border-radius: 15px; font-weight: bold; font-size: 0.8rem; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026</div>
    <div class="nav-links">
        <a href="index.php">Matchs</a>
        <a href="services.php">Transports & Hôtels</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <a href="admin/matches.php">Admin Panel</a>
            <?php else: ?>
                <span style="color:var(--gold);">👤 <?= htmlspecialchars($_SESSION['username']) ?></span>
            <?php endif; ?>
            <a href="logout.php" style="margin-left: 15px; color: #ffcccc;">Déco</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
        <?php endif; ?>
    </div>
</nav>

<div class="hero">
    <h1>BILLETTERIE OFFICIELLE</h1>
    <p>Vivez la passion du football africain au Maroc</p>
</div>

<div class="container">
    
    <div class="search-box">
        <input type="text" id="searchInput" onkeyup="searchMatch()" placeholder="Rechercher une équipe (ex: Maroc)...">
    </div>

    <?php if (count($matches) === 0): ?>
        <p style="text-align:center; padding: 50px;">Aucun match disponible pour le moment.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($matches as $match): ?>
            <div class="match-card">
                <div class="date-badge"><?= date('d/m', strtotime($match['date_match'])) ?></div>
                <div style="color:#666; font-size:0.9rem">
                    📍 <?= htmlspecialchars($match['nom_stade']) ?> (<?= htmlspecialchars($match['nom_ville']) ?>)
                </div>
                
                <div class="match-teams">
                    <?= htmlspecialchars($match['equipe1']) ?> 
                    <span style="color:#991b1b">VS</span> 
                    <?= htmlspecialchars($match['equipe2']) ?>
                </div>
                
                <div style="font-weight:bold; color:#064e3b; margin-top:5px;">
                    <?= $match['prix'] ?> DH
                </div>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="reservation.php?id=<?= $match['id_match'] ?>" class="btn">Réserver</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Se connecter</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

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