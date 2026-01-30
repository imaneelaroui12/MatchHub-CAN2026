<?php
/* FICHIER : services.php (VERSION FINALE : Sites Officiels Uniquement) */
session_start();
require_once 'config/db.php';

$message = "";

// 1. TRAITEMENT PHP (Sauvegarde Locale pour ta note)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
    $id_user = $_SESSION['user_id'];
    
    // On récupère la date
    $date_resa = isset($_POST['date_resa']) ? $_POST['date_resa'] : date('Y-m-d');

    // Cas Transport
    if (isset($_POST['btn_transport'])) {
        $id_trans = $_POST['transport_id'];
        $stmt = $pdo->prepare("SELECT * FROM transports WHERE id_transport = ?");
        $stmt->execute([$id_trans]);
        $transport = $stmt->fetch();
        if ($transport) {
            $details = $transport['type'] . " - " . $transport['trajet'] . " ($date_resa)";
            $sql = "INSERT INTO reservations_services (id_user, type_service, details, prix_total) VALUES (?, 'transport', ?, ?)";
            $pdo->prepare($sql)->execute([$id_user, $details, $transport['prix']]);
            $message = "<div class='alert success'>✅ Réservation Transport enregistrée !</div>";
        }
    }

    // Cas Hôtel
    if (isset($_POST['btn_hotel'])) {
        $id_hotel = $_POST['hotel_id'];
        $nuits = $_POST['nuits'];
        $stmt = $pdo->prepare("SELECT * FROM hotels WHERE id_hotel = ?");
        $stmt->execute([$id_hotel]);
        $hotel = $stmt->fetch();
        if ($hotel) {
            $prix_total = $hotel['prix_nuit'] * $nuits;
            $details = "Hôtel : " . $hotel['nom_hotel'] . " ($nuits nuits le $date_resa)";
            $sql = "INSERT INTO reservations_services (id_user, type_service, details, prix_total) VALUES (?, 'hotel', ?, ?)";
            $pdo->prepare($sql)->execute([$id_user, $details, $prix_total]);
            $message = "<div class='alert success'>✅ Réservation Hôtel enregistrée !</div>";
        }
    }
}

// Récupération des données BDD
$transports = $pdo->query("SELECT * FROM transports")->fetchAll();
$hotels = $pdo->query("SELECT * FROM hotels ORDER BY ville")->fetchAll();
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
        .container { max-width: 900px; margin: 40px auto; padding: 20px; }
        .service-card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-bottom: 40px; border-left: 6px solid var(--maroc-vert); }
        h2 { margin-top: 0; color: #1f2937; }
        select, input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        
        .btn-group { display: flex; gap: 10px; margin-top: 15px; }
        .btn-reserve { flex: 1; padding: 15px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; color: white; transition:0.3s; }
        .btn-transport { background: var(--maroc-vert); }
        .btn-hotel { background: var(--maroc-rouge); }
        
        /* Bouton Site Officiel */
        .btn-real { flex: 1; padding: 15px; background: white; border: 2px solid #ddd; border-radius: 8px; font-weight: bold; text-decoration: none; color: #333; text-align: center; cursor: pointer; transition:0.3s; }
        .btn-real:hover { background: #eee; border-color: #999; }

        .alert { padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .success { background: #dcfce7; color: #166534; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026</div>
    <div class="nav-links">
        <a href="index.php">Accueil</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Déco</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <?= $message ?>

    <div class="service-card">
        <h2>🚄 Transports Officiels</h2>
        <p>Réservez vos trajets train et navette.</p>
        <form method="POST">
            <label><strong>1. Date de départ :</strong></label>
            <input type="date" name="date_resa" id="dateTransport" required>

            <label><strong>2. Trajet :</strong></label>
            <select name="transport_id" id="selectTransport" required>
                <?php foreach($transports as $t): ?>
                    <option value="<?= $t['id_transport'] ?>" data-url="<?= $t['lien'] ?>">
                        <?= $t['type'] ?> : <?= $t['trajet'] ?> (<?= $t['prix'] ?> DH)
                    </option>
                <?php endforeach; ?>
            </select>
            
            <div class="btn-group">
                <button type="submit" name="btn_transport" class="btn-reserve btn-transport">RÉSERVER (LOCAL)</button>
                <button type="button" onclick="goToRealSite('selectTransport')" class="btn-real">🌍 Site Officiel</button>
            </div>
        </form>
    </div>

    <div class="service-card" style="border-left-color: var(--maroc-rouge);">
        <h2>🏨 Hôtels Partenaires</h2>
        <p>Hébergements certifiés CAN 2026.</p>
        <form method="POST">
            <label><strong>1. Date d'arrivée :</strong></label>
            <input type="date" name="date_resa" id="dateHotel" required>

            <label><strong>2. Hôtel :</strong></label>
            <select name="hotel_id" id="selectHotel" required>
                <?php foreach($hotels as $h): ?>
                    <option value="<?= $h['id_hotel'] ?>" data-url="<?= $h['lien'] ?>">
                        <?= $h['ville'] ?> - <?= $h['nom_hotel'] ?> (<?= $h['prix_nuit'] ?> DH/nuit)
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label><strong>3. Nombre de nuits :</strong></label>
            <input type="number" name="nuits" value="1" min="1" required>

            <div class="btn-group">
                <button type="submit" name="btn_hotel" class="btn-reserve btn-hotel">RÉSERVER (LOCAL)</button>
                <button type="button" onclick="goToRealSite('selectHotel')" class="btn-real">🌍 Site de l'Hôtel</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Initialisation de la date d'aujourd'hui
    let today = new Date().toISOString().split('T')[0];
    document.getElementById("dateTransport").value = today;
    document.getElementById("dateHotel").value = today;

    /**
     * FONCTION UNIQUE ET SIMPLE
     * Elle ne calcule rien. Elle ouvre juste le lien stocké dans la base de données.
     * Fini Booking.com !
     */
    function goToRealSite(selectId) {
        // 1. On trouve le menu déroulant (Select)
        let select = document.getElementById(selectId);
        
        // 2. On récupère le lien caché dans l'option sélectionnée (data-url)
        let url = select.options[select.selectedIndex].getAttribute("data-url");
        
        // 3. On ouvre le lien
        if(url && url !== '#' && url !== '') {
            window.open(url, '_blank');
        } else {
            alert("Lien officiel non disponible.");
        }
    }
</script>

</body>
</html>