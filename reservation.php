<?php
/* FICHIER : reservation.php */
session_start();
require_once 'config/db.php';

// 1. Sécurité : Si pas connecté, on renvoie au login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// 2. Vérification de l'ID du match
if (!isset($_GET['id'])) { die("Erreur : Aucun match sélectionné."); }
$id_match = $_GET['id'];
$id_user = $_SESSION['user_id'];
$message = "";

// 3. Récupérer les infos du match pour l'affichage (avec les noms des équipes et stades)
$sql = "SELECT m.*, e1.nom_equipe as eq1, e2.nom_equipe as eq2, s.nom_stade 
        FROM matchs m
        JOIN equipes e1 ON m.id_equipe1 = e1.id_equipe
        JOIN equipes e2 ON m.id_equipe2 = e2.id_equipe
        JOIN stades s ON m.id_stade = s.id_stade
        WHERE id_match = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_match]);
$match = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$match) { die("Match introuvable."); }

// 4. Traitement de la réservation (Clic sur CONFIRMER)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // On vérifie s'il reste des places
        if ($match['places_restantes'] > 0) {
            // A. Création du billet avec un numéro aléatoire
            $place = rand(1, 45000); 
            $insert = $pdo->prepare("INSERT INTO billets (id_user, id_match, numero_place) VALUES (?, ?, ?)");
            $insert->execute([$id_user, $id_match, $place]);

            // B. Mise à jour des places restantes (-1)
            $update = $pdo->prepare("UPDATE matchs SET places_restantes = places_restantes - 1 WHERE id_match = ?");
            $update->execute([$id_match]);

            $message = "<div style='background:#dcfce7; color:#166534; padding:20px; border-radius:10px; text-align:center; font-weight:bold; margin-bottom:20px;'>
                            ✅ Félicitations ! Votre billet #$place est réservé.
                        </div>";
            $match = null; // On cache le formulaire pour ne pas réserver deux fois
        } else {
            $message = "<div style='color:red; text-align:center;'>❌ Désolé, ce match est complet !</div>";
        }
    } catch (PDOException $e) {
        $message = "<div style='color:red; text-align:center;'>❌ Erreur : Vous avez probablement déjà réservé ce billet.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation - CAN 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
        .card { background: white; width: 100%; max-width: 500px; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; }
        h1 { color: #064e3b; margin-top:0; }
        .match-vs { font-size: 1.8em; font-weight: 800; color: #111; margin: 20px 0; }
        .info { color: #666; margin: 10px 0; font-size: 1.1em; }
        .price { font-size: 2.5em; color: #991b1b; font-weight: 800; margin: 20px 0; }
        .btn-confirm { background: #064e3b; color: white; border: none; padding: 15px 30px; font-size: 1.2em; border-radius: 10px; cursor: pointer; width:100%; font-weight:bold; transition:0.3s; }
        .btn-confirm:hover { background: #047857; transform: translateY(-2px); }
        .back-link { display: block; margin-top: 20px; color: #666; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <?= $message ?>

    <?php if ($match): ?>
        <h1>Confirmer l'achat</h1>
        <p>Vous êtes sur le point de réserver une place pour :</p>
        
        <div class="match-vs">
            <?= htmlspecialchars($match['eq1']) ?> <span style="color:#991b1b">VS</span> <?= htmlspecialchars($match['eq2']) ?>
        </div>
        
        <div class="info">📍 <?= htmlspecialchars($match['nom_stade']) ?></div>
        <div class="info">📅 <?= date('d/m/Y', strtotime($match['date_match'])) ?> à <?= date('H:i', strtotime($match['heure_match'])) ?></div>
        
        <div class="price"><?= number_format($match['prix'], 0) ?> DH</div>

        <form method="POST">
            <button type="submit" class="btn-confirm">PAYER ET RÉSERVER</button>
        </form>
    <?php endif; ?>

    <a href="index.php" class="back-link">← Retour au calendrier</a>
</div>

</body>
</html>