<?php
/* FICHIER : index.php (Page d'accueil publique) */
require_once 'config/db.php';

// On récupère les matchs pour les afficher
// ORDER BY match_date ASC : On affiche les matchs les plus proches en premier
$sql = "SELECT * FROM matches ORDER BY match_date ASC";
$stmt = $pdo->query($sql);
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchHub - Billetterie</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        
        /* La barre de navigation */
        header { background-color: #1a1a1a; color: white; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        header h1 { margin: 0; font-size: 1.5em; }
        .admin-link { color: #f1c40f; text-decoration: none; font-weight: bold; border: 1px solid #f1c40f; padding: 5px 15px; border-radius: 5px; }
        .admin-link:hover { background-color: #f1c40f; color: black; }

        /* Le conteneur des matchs */
        .container { max-width: 1000px; margin: 30px auto; padding: 20px; }
        .matches-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }

        /* La carte d'un match */
        .match-card { background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s; }
        .match-card:hover { transform: translateY(-5px); }
        
        .card-header { background-color: #007bff; color: white; padding: 15px; text-align: center; font-weight: bold; font-size: 1.2em; }
        .card-body { padding: 20px; text-align: center; }
        .teams { font-size: 1.4em; font-weight: bold; margin-bottom: 15px; color: #333; }
        .vs { color: #888; font-size: 0.8em; }
        .info { color: #666; margin-bottom: 5px; font-size: 0.9em; }
        .price { font-size: 1.5em; color: #28a745; font-weight: bold; margin: 15px 0; }
        
        .btn-buy { display: block; width: 100%; background-color: #28a745; color: white; text-align: center; padding: 10px 0; text-decoration: none; font-weight: bold; border-radius: 5px; }
        .btn-buy:hover { background-color: #218838; }
    </style>
</head>
<body>

    <header>
        <h1>⚽ MatchHub</h1>
        <a href="login.php" class="admin-link">Espace Admin</a>
    </header>

    <div class="container">
        <h2 style="text-align:center; margin-bottom: 30px;">Prochains Matchs</h2>

        <?php if (count($matches) === 0): ?>
            <p style="text-align:center">Aucun match disponible pour le moment.</p>
        <?php else: ?>
            
            <div class="matches-grid">
                <?php foreach ($matches as $match): ?>
                <div class="match-card">
                    <div class="card-header">
                        <?= date('d/m/Y', strtotime($match['match_date'])) ?> 
                        à <?= date('H:i', strtotime($match['match_date'])) ?>
                    </div>
                    
                    <div class="card-body">
                        <div class="teams">
                            <?= htmlspecialchars($match['team_home']) ?> 
                            <span class="vs">VS</span><br>
                            <?= htmlspecialchars($match['team_away']) ?>
                        </div>

                        <div class="info">📍 <?= htmlspecialchars($match['stadium']) ?></div>
                        
                        <div class="price"><?= htmlspecialchars($match['price']) ?> DH</div>

                        <a href="#" class="btn-buy">Réserver ma place</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>

</body>
</html>