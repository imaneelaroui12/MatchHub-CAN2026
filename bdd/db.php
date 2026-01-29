<?php
/**
 * Fichier de connexion à la base CAN 2026
 * À inclure dans toutes les pages PHP
 */

// Configuration de la connexion
$host = "localhost";      // Serveur MySQL
$dbname = "can_maroc_2026"; // Nom de la base
$username = "root";       // Identifiant MySQL
$password = "";           // Mot de passe MySQL

try {
    // Création de la connexion PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    // Message de debug (à enlever en production)
    // echo "<script>console.log('Connexion BDD CAN 2026 établie');</script>";
    
} catch (PDOException $e) {
    // En cas d'erreur
    die("<div style='color: red; padding: 20px; border: 2px solid red;'>
        <h3>❌ Erreur de connexion à la base de données</h3>
        <p><strong>Message :</strong> " . $e->getMessage() . "</p>
        <p>Vérifiez :</p>
        <ul>
            <li>MySQL est-il démarré ?</li>
            <li>Les identifiants dans db.php sont-ils corrects ?</li>
            <li>La base 'can_maroc_2026' existe-t-elle ?</li>
        </ul>
        </div>");
}

// Fonction utilitaire pour sécuriser les entrées
function securiser($data) {
    global $pdo;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $pdo->quote($data);
}
?>
