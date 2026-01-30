<?php
/**
 * Fichier de connexion à la base CAN 2026
 * Chemin : config/db.php
 */

// Configuration de la connexion
$host = "localhost";      // Serveur MySQL
$dbname = "can_maroc_2026"; // Nom de la base
$username = "root";       // Identifiant MySQL
$password = "";           // Mot de passe MySQL (Vide sur XAMPP)

try {
    // Création de la connexion PDO avec options avancées
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les erreurs
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Résultats en tableau associatif
        ]
    );
    
} catch (PDOException $e) {
    // En cas d'erreur critique, on arrête tout avec un beau message
    die("<div style='color: #721c24; background-color: #f8d7da; padding: 20px; border: 1px solid #f5c6cb; border-radius: 5px; font-family: sans-serif;'>
        <h3>❌ Erreur de connexion à la base de données</h3>
        <p><strong>Message :</strong> " . $e->getMessage() . "</p>
        <hr>
        <p>Vérifiez :</p>
        <ul>
            <li>MySQL est-il démarré dans XAMPP ?</li>
            <li>Le nom de la base 'can_maroc_2026' est-il correct ?</li>
        </ul>
        </div>");
}

// Fonction utilitaire pour sécuriser les données (si utilisée ailleurs)
function securiser($data) {
    global $pdo;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data; // Note: avec PDO préparé, quote() est moins nécessaire ici, htmlspecialchars suffit pour l'affichage
}
?>