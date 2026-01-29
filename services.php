<?php
/* FICHIER : services.php */
session_start();
require_once 'config/db.php';

$msg_transport = "";
$msg_hotel = "";

// TRAITEMENT DES FORMULAIRES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Si on n'est pas connecté, on redirige vers le login
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // Cas 1 : Réservation Transport
    if (isset($_POST['btn_transport'])) {
        $msg_transport = "<div style='background:#dcfce7; color:#166534; padding:15px; border-radius:10px; margin-bottom:15px;'>✅ Navette réservée avec succès ! (Simulation)</div>";
    }

    // Cas 2 : Recherche Hôtel
    if (isset($_POST['btn_hotel'])) {
        $msg_hotel = "<div style='background:#dbeafe; color:#1e40af; padding:15px; border-radius:10px; margin-bottom:15px;'>ℹ️ Recherche effectuée : 3 Hôtels trouvés. (Simulation)</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Services - CAN 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --maroc-vert: #064e3b; --maroc-rouge: #991b1b; --gold: #d4af37; }
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; margin: 0; }
        nav { background: linear-gradient(90deg, #064e3b 0%, #0d7a5d 100%); color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid var(--gold); }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; }
        .container { max-width: 800px; margin: 40px auto; padding: 20px; }
        .service-card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-bottom: 40px; border-left: 5px solid var(--maroc-vert); }
        .service-card h2 { margin-top: 0; color: #1f2937; }
        label { display: block; margin-top: 15px; font-weight: 600; color: #4b5563; }
        select, input { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #e5e7eb; border-radius: 8px; font-family: inherit; box-sizing: border-box;}
        .btn-service { width: 100%; padding: 15px; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; margin-top: 20px; font-size: 1.1rem; transition: 0.3s; color: white; }
        .btn-transport { background: #064e3b; }
        .btn-transport:hover { background: #047857; }
        .btn-hotel { background: #991b1b; }
        .btn-hotel:hover { background: #7f1d1d; }
        .note { background: #fffbeb; border-left: 4px solid #f59e0b; padding: 15px; margin-top: 20px; font-size: 0.9rem; color: #92400e; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026</div>
    <div class="nav-links">
        <a href="index.php">Calendrier</a>
        <a href="services.php" style="color:var(--gold)">Transport & Hôtels</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <div class="service-card">
        <h2>🚌 Transport & Navettes</h2>
        <?= $msg_transport ?>
        <form method="POST">
            <label>Ville de départ :</label>
            <select name="depart">
                <option>Rabat (Gare Agdal / Ville)</option>
                <option>Casablanca (Gare Voyageurs)</option>
                <option>Aéroport Mohammed V</option>
            </select>
            <label>Stade de destination :</label>
            <select name="destination">
                <option>Rabat - Prince Moulay Abdellah</option>
                <option>Casablanca - Stade Mohammed V</option>
            </select>
            <div class="note">💡 <strong>Note :</strong> Les navettes circulent 3h avant le match.</div>
            <button type="submit" name="btn_transport" class="btn-service btn-transport">RÉSERVER NAVETTE (50 DH)</button>
        </form>
    </div>

    <div class="service-card" style="border-left-color: var(--maroc-rouge);">
        <h2>🏨 Hébergement Partenaire</h2>
        <?= $msg_hotel ?>
        <form method="POST">
            <label>Ville Hôte :</label>
            <select name="ville">
                <option>Rabat</option>
                <option>Casablanca</option>
                <option>Marrakech</option>
            </select>
            <label>Type de logement :</label>
            <select name="type">
                <option>Hôtel 5★</option>
                <option>Hôtel 4★</option>
                <option>Appart'Hôtel</option>
            </select>
            <label>Nuitées :</label>
            <input type="number" name="nuits" placeholder="Ex: 2" min="1">
            <button type="submit" name="btn_hotel" class="btn-service btn-hotel">RECHERCHER DISPONIBILITÉS</button>
        </form>
    </div>
</div>

</body>
</html>