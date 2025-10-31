<?php
session_start();
require_once __DIR__ . '/../../controllers/ArticleController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$articleCtrl = new ArticleController();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'] ?? '',
        'description' => $_POST['description'] ?? '',
        'auteur' => $_POST['auteur'] ?? '',
        'email' => $_POST['email'] ?? '',
        'date_publication' => $_POST['date_publication'] ?? date('Y-m-d')
    ];

    if ($articleCtrl->create($data)) {
        $success = "Article créé avec succès !";
    } else {
        $error = "Erreur lors de la création de l'article.";
    }
}
?>

<h2>Créer un article</h2>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Auteur :</label><br>
    <input type="text" name="auteur" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Date publication :</label><br>
    <input type="date" name="date_publication"><br><br>

    <button type="submit">Créer</button>
</form>
<a href="dashboard.php">Retour au dashboard</a>