<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../utils/jwt.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data['email']) || empty($data['password'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Email et mot de passe requis']);
        exit;
    }

    $auth = new AuthController();
    $user = $auth->login($data['email'], $data['password']);

    if ($user) {
        $token = JWTHandler::createToken($user['id'], $user['email'], $user['role']);
        echo json_encode(['status' => 'success', 'token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Email ou mot de passe invalide']);
    }
}