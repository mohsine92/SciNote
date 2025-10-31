<?php
session_start();
require_once __DIR__ . '/../../models/Article.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $articleModel = new Article();
    $articleModel->delete($id);
}

header("Location: dashboard.php");
exit;