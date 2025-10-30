<?php
require_once __DIR__ . '/../models/Article.php';

class ArticleController {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    // Récupérer tous les articles
    public function getAll(): array {
        return $this->articleModel->getAll();
    }

    // Récupérer un article par ID
    public function getById(int $id): ?array {
        $article = $this->articleModel->getById($id);
        return $article ?: null;
    }

    // Créer un nouvel article
    public function create(array $data): bool {
        // On peut ici valider les champs si nécessaire
        return $this->articleModel->create($data);
    }

    // Mettre à jour un article
    public function update(int $id, array $data): bool {
        return $this->articleModel->update($id, $data);
    }

    // Supprimer un article
    public function delete(int $id): bool {
        return $this->articleModel->delete($id);
    }
}