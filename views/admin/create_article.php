<?php
require_once __DIR__ . '/../../models/Article.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'auteur' => $_POST['auteur'],
        'email' => $_POST['email'],
        'photo' => $_POST['photo'] ?? '',
        'date_publication' => date('Y-m-d H:i:s')
    ];

    $articleModel = new Article();
    $articleModel->create($data);
    $message = "Article créé avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter un Article</title>
</head>
<body>
<h1>Ajouter un Article</h1>

<?php if($message): ?>
<p><?= $message ?></p>
<?php endif; ?>

<form method="POST">
<label>Nom: <input type="text" name="nom" required></label><br><br>
<label>Description: <textarea name="description" required></textarea></label><br><br>
<label>Auteur: <input type="text" name="auteur" required></label><br><br>
<label>Email: <input type="email" name="email" required></label><br><br>
<label>Photo: <input type="text" name="photo"></label><br><br>
<button type="submit">Créer</button>
</form>
<a href="dashboard.php">Retour au dashboard</a>
</body>
</html>