<?php
/* FICHIER : login.php (Version compatible Base de Données Collègue) */
session_start();
require_once 'config/db.php';

$error = "";

// Si le formulaire est envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. On récupère l'email (et plus le username)
    $email = $_POST['email']; 
    $password = $_POST['password'];

    // 2. On cherche l'utilisateur par son EMAIL
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3. Vérification du mot de passe
    // Note : Dans un vrai projet, on utiliserait password_verify(), mais ta collègue n'a pas haché les mots de passe
    if ($user && $password === $user['password']) {
        
        // 4. On enregistre les bonnes infos en session
        // ATTENTION : Dans sa base, c'est 'id_user' et 'nom'
        $_SESSION['user_id'] = $user['id_user']; 
        $_SESSION['username'] = $user['nom']; // On garde 'username' pour l'affichage, mais on y met le nom
        $_SESSION['role'] = $user['role'];

       // LOGIQUE DE REDIRECTION SELON LE RÔLE
if ($user['role'] === 'admin') {
    // Si c'est l'admin, il va gérer les matchs
    header("Location: admin/matches.php");
} else {
    // Si c'est un supporter, il retourne à l'accueil pour acheter
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
        h2 { color: #991b1b; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 10px 0; box-sizing: border-box; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; }
        button { width: 100%; padding: 12px; background: #064e3b; color: white; border: none; cursor: pointer; border-radius: 8px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        button:hover { background: #0d7a5d; }
        .error { color: red; font-size: 0.9em; margin-bottom: 10px; }
        .back-link { display: block; margin-top: 15px; color: #666; text-decoration: none; font-size: 0.9rem; }
        .back-link:hover { color: #000; }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Espace Admin</h2>
        
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email (ex: admin@can2026.ma)" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <a href="index.php" class="back-link">← Retour au site</a>
    </div>

</body>
</html>