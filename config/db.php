<?php
/* FICHIER : config/db.php
   BUT : Se connecter à la base de données matchhub_db 
*/

$host = 'localhost';      // Le serveur (c'est ton ordi)
$dbname = 'matchhub_db';  // Le nom de ta base créée à l'étape 2
$username = 'root';       // L'utilisateur par défaut de XAMPP
$password = '';           // Sur XAMPP, il n'y a pas de mot de passe par défaut

try {
    // On crée la connexion (on appelle ça une instance PDO)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // On configure pour que PHP nous affiche les erreurs SQL (très utile pour débugger)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Si ça marche, on ne fait rien, le script continue...
} catch (PDOException $e) {
    // Si ça plante, on arrête tout et on affiche l'erreur
    die("❌ Erreur de connexion à la base de données : " . $e->getMessage());
}
?>