<?php
require_once __DIR__ . '/../config/database.php';

class Article {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Récupérer tous les articles
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM articles ORDER BY date_publication DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un article par ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un nouvel article
    public function create($data) {
        $datePub = $data['date_publication'] ?? date('Y-m-d H:i:s');

        $stmt = $this->pdo->prepare(
            "INSERT INTO articles (nom, description, date_publication, auteur, email, photo)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nom'],
            $data['description'],
            $datePub,
            $data['auteur'],
            $data['email'],
            $data['photo'] ?? null
        ]);
    }

    // Mettre à jour un article existant
    public function update($id, $data) {
        $datePub = $data['date_publication'] ?? date('Y-m-d H:i:s');

        $stmt = $this->pdo->prepare(
            "UPDATE articles SET nom=?, description=?, date_publication=?, auteur=?, email=?, photo=? WHERE id=?"
        );
        return $stmt->execute([
            $data['nom'],
            $data['description'],
            $datePub,
            $data['auteur'],
            $data['email'],
            $data['photo'] ?? null,
            $id
        ]);
    }

    // Supprimer un article
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id=?");
        return $stmt->execute([$id]);
    }
}