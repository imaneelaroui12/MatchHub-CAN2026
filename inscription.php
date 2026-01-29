<?php
/* FICHIER : inscription.php (Réparé et compatible) */
session_start();
require_once 'config/db.php';

$message = "";

// TRAITEMENT DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Note : On ne récupère pas la "ville" car elle n'existe pas dans la table 'users' de ta collègue.

    // 2. Vérification si l'email existe déjà
    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);
    
    if ($check->rowCount() > 0) {
        $message = "<div style='color:red; text-align:center; margin-bottom:10px;'>❌ Cet email est déjà utilisé !</div>";
    } else {
        // 3. Insertion du nouvel utilisateur
        // Par défaut, le rôle est 'client'
        try {
            $sql = "INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, 'client')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $email, $password]);
            
            // Succès : On redirige vers le login
            header("Location: login.php?inscrit=1");
            exit;
        } catch (PDOException $e) {
            $message = "<div style='color:red; text-align:center;'>❌ Erreur : " . $e->getMessage() . "</div>";
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
        /* Ton CSS (adapté pour centrer et styliser) */
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .register-container { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        h2 { text-align: center; color: #064e3b; margin-bottom: 10px; font-size: 2rem; }
        p.subtitle { text-align: center; color: #666; margin-bottom: 30px; font-size: 0.9rem; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; color: #374151; margin-bottom: 8px; }
        input, select { width: 100%; padding: 12px 15px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 1rem; box-sizing: border-box; transition: 0.3s; font-family: inherit; }
        input:focus, select:focus { border-color: #064e3b; outline: none; box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.1); }
        
        .btn-submit { background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%); color: white; width: 100%; padding: 15px; border: none; border-radius: 10px; font-weight: 800; font-size: 1.1rem; cursor: pointer; text-transform: uppercase; transition: transform 0.2s; margin-top: 10px; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(153, 27, 27, 0.3); }
        
        .login-link { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #4b5563; }
        .login-link a { color: #064e3b; font-weight: bold; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Créer un compte</h2>
        <p class="subtitle">Rejoignez la communauté des supporters de la CAN 2026.</p>

        <?= $message ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Nom Complet</label>
                <input type="text" name="nom" placeholder="Ex: Yassine Bounou" required>
            </div>

            <div class="form-group">
                <label>Adresse Email</label>
                <input type="email" name="email" placeholder="votre@email.com" required>
            </div>

            <div class="form-group">
                <label>Ville de préférence (Billetterie)</label>
                <select name="ville_fake">
                    <option>Rabat (4 stades)</option>
                    <option>Casablanca</option>
                    <option>Marrakech</option>
                    <option>Tanger</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">CRÉER MON COMPTE SUPPORTER</button>
        </form>

        <div class="login-link">
            Déjà inscrit ? <a href="login.php">Se connecter</a>
        </div>
        <div class="login-link">
             <a href="index.php">← Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>