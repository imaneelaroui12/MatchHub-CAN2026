<?php
/* FICHIER : admin/delete_match.php (Version Corrigée) */
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: ../login.php"); exit; }
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // CORRECTION : La table est 'matchs' et la colonne est 'id_match'
    $sql = "DELETE FROM matchs WHERE id_match = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header("Location: matches.php");
exit;
?>