<?php
session_start();
require_once __DIR__ . '/../../controllers/ArticleController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$articleCtrl = new ArticleController();
$articles = $articleCtrl->getAll();
?>

<h2>Dashboard Admin</h2>
<a href="create_article.php">Créer un article</a> | 
<a href="logout.php">Se déconnecter</a>

<h3>Liste des articles</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Auteur</th>
        <th>Email</th>
        <th>Date publication</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($articles as $a): ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= htmlspecialchars($a['nom']) ?></td>
        <td><?= htmlspecialchars($a['description']) ?></td>
        <td><?= htmlspecialchars($a['auteur']) ?></td>
        <td><?= htmlspecialchars($a['email']) ?></td>
        <td><?= htmlspecialchars($a['date_publication']) ?></td>
        <td>
            <a href="edit_article.php?id=<?= $a['id'] ?>">Modifier</a> |
            <a href="delete_article.php?id=<?= $a['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>