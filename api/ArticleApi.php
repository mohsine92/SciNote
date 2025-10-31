<?php
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../utils/jwt.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Gestion des requêtes OPTIONS (préflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Récupération du token JWT
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
$token = str_replace('Bearer ', '', $authHeader);
$userData = JWTHandler::validateToken($token);

// Connexion au modèle Article
$articleModel = new Article();

// --- ROUTES CRUD ---
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Lecture accessible à tous
        if (isset($_GET['id'])) {
            $article = $articleModel->getById($_GET['id']);
            echo json_encode($article ?: ['message' => 'Aucun article trouvé']);
        } else {
            echo json_encode($articleModel->getAll());
        }
        break;

    case 'POST':
    case 'PUT':
    case 'DELETE':
        // Pour créer, modifier ou supprimer, il faut un utilisateur connecté
        if (!$userData) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Token manquant ou invalide']);
            exit;
        }

        // Créer un article
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (empty($data['nom']) || empty($data['description']) || empty($data['auteur']) || empty($data['email'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Champs obligatoires manquants']);
                exit;
            }
            $articleModel->create($data);
            echo json_encode(['status' => 'success', 'message' => 'Article créé avec succès']);
        }

        // Modifier un article
        if ($method === 'PUT') {
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'ID requis']);
                exit;
            }
            $data = json_decode(file_get_contents("php://input"), true);
            $updated = $articleModel->update($_GET['id'], $data);
            echo json_encode([
                'status' => $updated ? 'success' : 'error',
                'message' => $updated ? 'Article mis à jour' : 'Erreur lors de la mise à jour'
            ]);
        }

        // Supprimer un article
        if ($method === 'DELETE') {
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'ID requis']);
                exit;
            }
            $deleted = $articleModel->delete($_GET['id']);
            echo json_encode([
                'status' => $deleted ? 'success' : 'error',
                'message' => $deleted ? 'Article supprimé' : 'Erreur lors de la suppression'
            ]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
        break;
}