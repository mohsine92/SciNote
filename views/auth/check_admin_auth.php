<?php
// Vérifie si la session est déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si l'admin n'est pas connecté, redirige vers la page de connexion
if (!isset($_SESSION['admin_id'])) {
    header('Location: /SciNote/views/admin/login.php');
    exit;
}
?>