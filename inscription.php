<?php
/* FICHIER : inscription.php (Compatible nouvelle Base de Données) */
session_start();
require_once 'config/db.php';

$message = "";

// TRAITEMENT DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Récupération des données
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 2. Vérification si l'email existe déjà
    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);
    
    if ($check->rowCount() > 0) {
        $message = "<div style='color:red; background:#fee2e2; padding:10px; border-radius:5px; margin-bottom:15px;'>❌ Cet email est déjà utilisé !</div>";
    } else {
        // 3. Insertion du nouvel utilisateur (Rôle 'client' par défaut)
        try {
            $sql = "INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, 'client')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $email, $password]);
            
            // Succès : On redirige vers le login avec un petit message
            header("Location: login.php?inscrit=1");
            exit;
        } catch (PDOException $e) {
            $message = "<div style='color:red'>❌ Erreur technique : " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - CAN 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .register-container { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align:center; }
        h2 { color: #064e3b; margin-bottom: 10px; font-size: 1.8rem; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #e5e7eb; border-radius: 8px; box-sizing: border-box; font-family: inherit; }
        .btn-submit { background: #991b1b; color: white; width: 100%; padding: 12px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 1rem; margin-top: 10px; }
        .btn-submit:hover { background: #7f1d1d; }
        .login-link { margin-top: 20px; font-size: 0.9rem; color: #666; }
        .login-link a { color: #064e3b; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Créer un compte</h2>
        <p style="color:#666; font-size:0.9rem; margin-bottom:20px;">Rejoignez la fête du football africain</p>

        <?= $message ?>

        <form method="POST">
            <input type="text" name="nom" placeholder="Nom Complet (ex: Achraf Hakimi)" required>
            <input type="email" name="email" placeholder="Email (ex: fan@can2026.ma)" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            
            <button type="submit" class="btn-submit">S'INSCRIRE</button>
        </form>

        <div class="login-link">
            Déjà un compte ? <a href="login.php">Se connecter</a>
        </div>
        <div class="login-link">
             <a href="index.php">← Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>