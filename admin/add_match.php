<?php
/* FICHIER : admin/add_match.php (Version Corrigée et Sécurisée) */
session_start();
// Sécurité : Si pas connecté, on redirige vers le login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../config/db.php';
$message = "";

// 1. On récupère les listes pour les menus déroulants
// On utilise try/catch pour éviter une erreur si les tables sont vides
try {
    $equipes = $pdo->query("SELECT * FROM equipes ORDER BY nom_equipe ASC")->fetchAll();
    $stades = $pdo->query("SELECT * FROM stades ORDER BY nom_stade ASC")->fetchAll();
} catch (PDOException $e) {
    $equipes = [];
    $stades = [];
    $message = "<div style='color:orange'>⚠️ Attention : Tables 'equipes' ou 'stades' vides ou introuvables.</div>";
}

// 2. Si le formulaire est envoyé (méthode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // --- SÉCURITÉ : On vérifie que tous les champs sont bien là ---
    if (
        isset($_POST['id_equipe1']) && 
        isset($_POST['id_equipe2']) && 
        isset($_POST['id_stade']) && 
        isset($_POST['date_match']) && 
        isset($_POST['heure_match']) && 
        isset($_POST['prix'])
    ) {
        // On récupère les données proprement
        $id_eq1 = $_POST['id_equipe1'];
        $id_eq2 = $_POST['id_equipe2'];
        $id_stade = $_POST['id_stade'];
        $date = $_POST['date_match'];
        $heure = $_POST['heure_match'];
        $prix = $_POST['prix'];
        $places = 45000; // Valeur par défaut

        try {
            // Insertion dans la table 'matchs'
            $sql = "INSERT INTO matchs (id_equipe1, id_equipe2, id_stade, date_match, heure_match, prix, places_restantes) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_eq1, $id_eq2, $id_stade, $date, $heure, $prix, $places]);
            
            $message = "<div style='color:green; font-weight:bold;'>✅ Match ajouté avec succès !</div>";
        } catch (PDOException $e) {
            $message = "<div style='color:red; font-weight:bold;'>❌ Erreur SQL : " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div style='color:red;'>❌ Erreur : Certains champs du formulaire sont manquants.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Match</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 20px; background-color: #f4f4f4; }
        form { background: white; padding: 20px; max-width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        select, input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { margin-top: 20px; width: 100%; padding: 10px; background-color: #064e3b; color: white; border: none; font-size: 1.1em; cursor: pointer; border-radius: 4px; }
        button:hover { background-color: #0d7a5d; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; }
    </style>
</head>
<body>

    <h2 style="text-align:center">Planifier un nouveau match</h2>
    
    <?= $message ?>

    <form method="POST">
        <label>Équipe Domicile :</label>
        <select name="id_equipe1" required>
            <option value="">-- Choisir une équipe --</option>
            <?php foreach($equipes as $eq): ?>
                <option value="<?= $eq['id_equipe'] ?? $eq['id'] ?>">
                    <?= $eq['nom_equipe'] ?? 'Nom inconnu' ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Équipe Extérieur :</label>
        <select name="id_equipe2" required>
            <option value="">-- Choisir une équipe --</option>
            <?php foreach($equipes as $eq): ?>
                <option value="<?= $eq['id_equipe'] ?? $eq['id'] ?>">
                    <?= $eq['nom_equipe'] ?? 'Nom inconnu' ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Stade :</label>
        <select name="id_stade" required>
            <option value="">-- Choisir un stade --</option>
            <?php foreach($stades as $s): ?>
                <option value="<?= $s['id_stade'] ?? $s['id'] ?>">
                    <?= $s['nom_stade'] ?? 'Stade inconnu' ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Date du match :</label>
        <input type="date" name="date_match" required>

        <label>Heure du coup d'envoi :</label>
        <input type="time" name="heure_match" required>

        <label>Prix du billet (DH) :</label>
        <input type="number" name="prix" placeholder="Ex: 200" required>

        <button type="submit">Enregistrer le match</button>
        
        <a href="matches.php" class="btn-back">← Retour à la liste</a>
    </form>

</body>
</html>