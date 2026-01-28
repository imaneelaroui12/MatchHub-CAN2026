<?php
session_start(); // On récupère la session

// Si la variable 'user_id' n'existe pas, c'est que la personne n'est pas connectée
if (!isset($_SESSION['user_id'])) {
    // Hop, on le renvoie au login
    header("Location: ../login.php");
    exit;
}

// ... le reste de ton code ne change pas ...
require_once '../config/db.php';
// ...

/* FICHIER : admin/delete_match.php */
require_once '../config/db.php';

// On vérifie qu'on a bien un ID dans l'URL (ex: delete_match.php?id=4)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requete de suppression
    $sql = "DELETE FROM matches WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// Quoi qu'il arrive, on retourne à la liste
header("Location: matches.php");
exit;
?>