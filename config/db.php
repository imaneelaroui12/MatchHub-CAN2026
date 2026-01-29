<?php
$host = 'localhost';
$dbname = 'matchhub_db'; // Doit être identique au nom créé dans phpmyadmin
$username = 'root';      // Par défaut sur XAMPP
$password = '';          // Par défaut vide sur XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>