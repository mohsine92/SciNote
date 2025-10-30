<?php
require_once 'config/database.php';

$pdo = Database::connect();
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($users);
echo '</pre>';