<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login($email, $password) {
        return $this->user->login($email, $password);
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}