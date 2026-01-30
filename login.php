<?php
/* FICHIER : login.php (Avec lien Inscription) */
session_start();
require_once 'config/db.php';

$error = "";
$success = "";

// Message de succès si on vient de s'inscrire
if (isset($_GET['inscrit'])) {
    $success = "✅ Compte créé ! Connectez-vous maintenant.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; 
    $password = $_POST['password'];

    // Vérification dans la NOUVELLE table users
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id_user']; 
        $_SESSION['username'] = $user['nom'];
        $_SESSION['role'] = $user['role'];

        // Redirection intelligente
        if ($user['role'] === 'admin') {
            header("Location: admin/matches.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Email ou mot de passe incorrect !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - CAN 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f3f4f6; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h2 { color: #064e3b; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 10px 0; box-sizing: border-box; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; }
        button { width: 100%; padding: 12px; background: #064e3b; color: white; border: none; cursor: pointer; border-radius: 8px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        button:hover { background: #0d7a5d; }
        .error { color: red; background:#fee2e2; padding:10px; border-radius:5px; font-size: 0.9em; margin-bottom: 10px; }
        .success { color: green; background:#dcfce7; padding:10px; border-radius:5px; font-size: 0.9em; margin-bottom: 10px; }
        .links { margin-top: 20px; font-size: 0.9rem; }
        .links a { color: #666; text-decoration: none; display:block; margin: 5px 0; }
        .links a:hover { color: #000; text-decoration: underline; }
        .register-link { color: #991b1b !important; font-weight:bold; }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Connexion</h2>
        
        <?php if ($error): ?> <div class="error"><?= $error ?></div> <?php endif; ?>
        <?php if ($success): ?> <div class="success"><?= $success ?></div> <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <div class="links">
            <a href="inscription.php" class="register-link">Pas encore de compte ? S'inscrire</a>
            
            <a href="index.php">← Retour au site</a>
        </div>
    </div>

</body>
</html>