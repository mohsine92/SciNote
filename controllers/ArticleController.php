<?php
require_once __DIR__ . '/../models/Article.php';

class ArticleController {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function getAll(): array {
        return $this->articleModel->getAll();
    }

    public function getById(int $id): ?array {
        return $this->articleModel->getById($id) ?: null;
    }

    public function create(array $data): bool {
        return $this->articleModel->create($data);
    }

    public function update(int $id, array $data): bool {
        return $this->articleModel->update($id, $data);
    }

    public function delete(int $id): bool {
        return $this->articleModel->delete($id);
    }
}