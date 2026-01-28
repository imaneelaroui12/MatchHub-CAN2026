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

/* FICHIER : admin/edit_match.php */
require_once '../config/db.php';

// 1. Si on n'a pas d'ID, on dégage
if (!isset($_GET['id'])) {
    header("Location: matches.php");
    exit;
}

$id = $_GET['id'];
$message = "";

// 2. Si le formulaire est soumis (Mise à jour)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $home = $_POST['team_home'];
    $away = $_POST['team_away'];
    $date = $_POST['match_date'];
    $stadium = $_POST['stadium'];
    $price = $_POST['price'];

    $sql = "UPDATE matches SET team_home=?, team_away=?, match_date=?, stadium=?, price=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$home, $away, $date, $stadium, $price, $id])) {
        // Redirection vers la liste après succès
        header("Location: matches.php");
        exit;
    } else {
        $message = "Erreur lors de la modification.";
    }
}

// 3. Récupérer les infos actuelles du match pour pré-remplir le formulaire
$stmt = $pdo->prepare("SELECT * FROM matches WHERE id = ?");
$stmt->execute([$id]);
$match = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'ID n'existe pas dans la base
if (!$match) {
    die("Match introuvable !");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Match</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        form { max-width: 400px; margin-top: 20px; }
        input, button { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { background-color: #ffc107; border: none; cursor: pointer; color: black; font-weight: bold;}
    </style>
</head>
<body>

    <h1>Modifier le match</h1>
    <?= $message ?>

    <form method="POST">
        <label>Équipe Domicile :</label>
        <input type="text" name="team_home" value="<?= htmlspecialchars($match['team_home']) ?>" required>

        <label>Équipe Extérieur :</label>
        <input type="text" name="team_away" value="<?= htmlspecialchars($match['team_away']) ?>" required>

        <label>Date (Actuelle : <?= $match['match_date'] ?>) :</label>
        <input type="datetime-local" name="match_date" value="<?= date('Y-m-d\TH:i', strtotime($match['match_date'])) ?>" required>

        <label>Stade :</label>
        <input type="text" name="stadium" value="<?= htmlspecialchars($match['stadium']) ?>" required>

        <label>Prix :</label>
        <input type="number" name="price" value="<?= htmlspecialchars($match['price']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
    
    <a href="matches.php">Annuler</a>

</body>
</html>