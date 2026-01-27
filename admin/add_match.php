<?php
/* FICHIER : admin/add_match.php
   BUT : Formulaire pour insérer un match dans la table 'matches'
*/

// 1. On inclut la connexion qu'on vient de créer
require_once '../config/db.php';

$message = ""; // Variable pour afficher confirmation ou erreur

// 2. On vérifie si l'utilisateur a cliqué sur le bouton "Ajouter"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // On récupère les données du formulaire
    $home = $_POST['team_home'];
    $away = $_POST['team_away'];
    $date = $_POST['match_date'];
    $stadium = $_POST['stadium'];
    $price = $_POST['price'];

    // 3. On prépare la requête SQL (C'est sécurisé contre le piratage)
    $sql = "INSERT INTO matches (team_home, team_away, match_date, stadium, price) 
            VALUES (:home, :away, :date, :stadium, :price)";
    
    $stmt = $pdo->prepare($sql);

    // 4. On exécute la requête en remplissant les trous
    try {
        $stmt->execute([
            ':home' => $home,
            ':away' => $away,
            ':date' => $date,
            ':stadium' => $stadium,
            ':price' => $price
        ]);
        $message = "<div style='color:green'>✅ Le match a été ajouté avec succès !</div>";
    } catch (PDOException $e) {
        $message = "<div style='color:red'>❌ Erreur lors de l'ajout : " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Match - Admin</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        form { max-width: 400px; margin-top: 20px; }
        input, button { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <h1>Ajouter un nouveau match</h1>
    
    <?= $message ?>

    <form method="POST" action="">
        <label>Équipe Domicile :</label>
        <input type="text" name="team_home" placeholder="Ex: Maroc" required>

        <label>Équipe Extérieur :</label>
        <input type="text" name="team_away" placeholder="Ex: Sénégal" required>

        <label>Date et Heure :</label>
        <input type="datetime-local" name="match_date" required>

        <label>Stade :</label>
        <input type="text" name="stadium" placeholder="Ex: Stade Mohammed V" required>

        <label>Prix du billet (DH) :</label>
        <input type="number" name="price" placeholder="Ex: 200" required>

        <button type="submit">Enregistrer le match</button>
    </form>
    
    <br>
    <a href="dashboard.php">Retour au tableau de bord</a>

</body>
</html>