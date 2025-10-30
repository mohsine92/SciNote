<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && password_verify($password, $user['password']) ? $user : false;
    }
}