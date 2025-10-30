<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../utils/jwt.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
if (empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Email et mot de passe requis']);
    exit;
}

$userModel = new User();
$user = $userModel->login($data['email'], $data['password']);

if (!$user) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Email ou mot de passe invalide']);
    exit;
}

// Création du token
$token = JWTHandler::createToken(['id' => $user['id'], 'email' => $user['email'], 'role' => $user['role']]);
echo json_encode(['status' => 'success', 'token' => $token]);