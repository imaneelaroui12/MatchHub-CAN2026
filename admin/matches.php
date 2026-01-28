<?php
session_start(); // On récupère la session

// Si la variable 'user_id' n'existe pas, c'est que la personne n'est pas connectée
if (!isset($_SESSION['user_id'])) {
    // Hop, on le renvoie au login
    header("Location: ../login.php");
    exit;
}

// ... le reste de ton code ne change pas ...
require_once '../config/db.php';
// ...

/* FICHIER : admin/matches.php
   BUT : Afficher la liste de tous les matchs sous forme de tableau
*/
require_once '../config/db.php';

// On récupère tous les matchs, du plus récent au plus ancien
$sql = "SELECT * FROM matches ORDER BY match_date DESC";
$stmt = $pdo->query($sql);
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Matchs - Admin</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { text-decoration: none; padding: 5px 10px; color: white; border-radius: 4px; }
        .btn-add { background-color: #28a745; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-delete { background-color: #dc3545; }
    </style>
</head>
<body>

    <h1>Gestion des Matchs</h1>
    
    <a href="add_match.php" class="btn btn-add">+ Ajouter un nouveau match</a>

    <table>
        <thead>
            <tr>
                <th>Date</th>
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
                <td><?= date('d/m/Y H:i', strtotime($match['match_date'])) ?></td>
                <td><?= htmlspecialchars($match['team_home']) ?></td>
                <td><?= htmlspecialchars($match['team_away']) ?></td>
                <td><?= htmlspecialchars($match['stadium']) ?></td>
                <td><?= htmlspecialchars($match['price']) ?> DH</td>
                <td>
                    <a href="edit_match.php?id=<?= $match['id'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete_match.php?id=<?= $match['id'] ?>" class="btn btn-delete" onclick="return confirm('Sûr de vouloir supprimer ?')">Supprimer</a>
                    <a href="../logout.php" style="float:right; color:red; text-decoration:none;">Se déconnecter ❌</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>