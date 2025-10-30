<?php
require_once __DIR__ . '/../../models/Article.php';

$articleModel = new Article();
$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID manquant');
}

$article = $articleModel->getById($id);
if (!$article) {
    die('Article introuvable');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'auteur' => $_POST['auteur'],
        'email' => $_POST['email'],
        'photo' => $_POST['photo'] ?? '',
        'date_publication' => $article['date_publication'] // garder la date existante
    ];

    $articleModel->update($id, $data);
    $message = "Article mis à jour !";
    $article = $articleModel->getById($id); // refresh
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Éditer Article</title>
</head>
<body>
<h1>Éditer Article</h1>

<?php if($message): ?>
<p><?= $message ?></p>
<?php endif; ?>

<form method="POST">
<label>Nom: <input type="text" name="nom" value="<?= htmlspecialchars($article['nom']) ?>" required></label><br><br>
<label>Description: <textarea name="description" required><?= htmlspecialchars($article['description']) ?></textarea></label><br><br>
<label>Auteur: <input type="text" name="auteur" value="<?= htmlspecialchars($article['auteur']) ?>" required></label><br><br>
<label>Email: <input type="email" name="email" value="<?= htmlspecialchars($article['email']) ?>" required></label><br><br>
<label>Photo: <input type="text" name="photo" value="<?= htmlspecialchars($article['photo']) ?>"></label><br><br>
<button type="submit">Mettre à jour</button>
</form>
<a href="dashboard.php">Retour au dashboard</a>
</body>
</html>