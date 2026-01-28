<?php
session_start();
session_destroy(); // On détruit la session (oubli total)
header("Location: login.php"); // Retour au login
exit;
?>