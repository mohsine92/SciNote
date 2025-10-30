<?php
require_once __DIR__ . '/../../models/Article.php';

$articleModel = new Article();
$articles = $articleModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<style>
body { font-family: Arial, sans-serif; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
a { margin-right: 10px; }
</style>
</head>
<body>
<h1>Dashboard Admin</h1>
<a href="create_article.php">Ajouter un Article</a>
<table>
<thead>
<tr>
<th>ID</th>
<th>Nom</th>
<th>Description</th>
<th>Auteur</th>
<th>Email</th>
<th>Date</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($articles as $article): ?>
<tr>
<td><?= $article['id'] ?></td>
<td><?= htmlspecialchars($article['nom']) ?></td>
<td><?= htmlspecialchars($article['description']) ?></td>
<td><?= htmlspecialchars($article['auteur']) ?></td>
<td><?= htmlspecialchars($article['email']) ?></td>
<td><?= $article['date_publication'] ?></td>
<td>
<a href="edit_article.php?id=<?= $article['id'] ?>">Éditer</a>
<a href="delete_article.php?id=<?= $article['id'] ?>" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body>
</html>