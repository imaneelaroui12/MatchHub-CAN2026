<?php
/* FICHIER : admin/matches.php (Version compatible BDD Collègue) */
session_start();
// Vérification de sécurité : Si pas connecté, on vire !
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../config/db.php';

// REQUETE CORRIGÉE : Table 'matchs' + Jointures pour avoir les noms
$sql = "SELECT m.id_match, m.date_match, m.heure_match, m.prix,
               e1.nom_equipe AS equipe1, 
               e2.nom_equipe AS equipe2, 
               s.nom_stade
        FROM matchs m
        JOIN equipes e1 ON m.id_equipe1 = e1.id_equipe
        JOIN equipes e2 ON m.id_equipe2 = e2.id_equipe
        JOIN stades s ON m.id_stade = s.id_stade
        ORDER BY m.date_match DESC";

$stmt = $pdo->query($sql);
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Matchs - Admin</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 20px; background-color: #f4f4f4; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #064e3b; color: white; }
        tr:hover { background-color: #f1f1f1; }
        
        .btn { text-decoration: none; padding: 8px 12px; border-radius: 4px; color: white; font-size: 0.9em; }
        .btn-add { background-color: #0d7a5d; padding: 10px 20px; font-weight: bold; }
        .btn-edit { background-color: #d97706; }
        .btn-delete { background-color: #991b1b; }
        .btn-logout { color: #991b1b; text-decoration: none; font-weight: bold; border: 1px solid #991b1b; padding: 5px 10px; border-radius: 5px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Gestion des Matchs</h1>
        <div>
            <a href="../index.php" style="margin-right: 15px; color:#333;">Voir le site</a>
            <a href="../logout.php" class="btn-logout">Déconnexion</a>
        </div>
    </div>
    
    <a href="add_match.php" class="btn btn-add">+ Ajouter un match</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Domicile</th>
                <th>Extérieur</th>
                <th>Stade</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matches as $match): ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($match['date_match'])) ?></td>
                <td><?= date('H:i', strtotime($match['heure_match'])) ?></td>
                
                <td><strong><?= htmlspecialchars($match['equipe1']) ?></strong></td>
                <td><strong><?= htmlspecialchars($match['equipe2']) ?></strong></td>
                <td><?= htmlspecialchars($match['nom_stade']) ?></td>
                <td><?= htmlspecialchars($match['prix']) ?> DH</td>
                
                <td>
                    <a href="edit_match.php?id=<?= $match['id_match'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete_match.php?id=<?= $match['id_match'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer ce match ?')">X</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>