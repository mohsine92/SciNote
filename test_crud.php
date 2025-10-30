<?php
require_once __DIR__ . '/models/Article.php';

// Création du modèle
$articleModel = new Article();

// Gestion des actions via GET (pour tester simplement)
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;
$message = '';
$result = null;

switch ($action) {
    case 'create':
        $data = [
            'nom' => 'Article Test',
            'description' => 'Description test',
            'auteur' => 'Mohsine',
            'email' => 'admin@example.com',
            'photo' => 'test.jpg',
            'date_publication' => date('Y-m-d H:i:s')
        ];
        $articleModel->create($data);
        $message = "Article créé !";
        break;

    case 'read':
        $result = $articleModel->getAll();
        break;

    case 'readOne':
        if ($id) $result = $articleModel->getById($id);
        break;

    case 'update':
        if ($id) {
            $data = ['description' => 'Nouvelle description', 'date_publication' => date('Y-m-d H:i:s')];
            $articleModel->update($id, $data);
            $message = "Article mis à jour !";
        }
        break;

    case 'delete':
        if ($id) {
            $articleModel->delete($id);
            $message = "Article supprimé !";
        }
        break;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Test CRUD Articles</title>
<style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    a { margin-right: 10px; }
    pre { background: #f4f4f4; padding: 10px; }
</style>
</head>
<body>
<h1>Test CRUD Articles</h1>

<div>
    <a href="?action=create">Créer Article</a>
    <a href="?action=read">Lister tous les Articles</a>
    <a href="?action=readOne&id=1">Lire Article ID 1</a>
    <a href="?action=update&id=1">Mettre à jour Article ID 1</a>
    <a href="?action=delete&id=1">Supprimer Article ID 1</a>
</div>

<?php if($message): ?>
    <h2><?= $message ?></h2>
<?php endif; ?>

<?php if($result): ?>
    <h2>Résultat :</h2>
    <pre><?= print_r($result, true) ?></pre>
<?php endif; ?>

</body>
</html>