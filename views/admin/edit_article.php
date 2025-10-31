<?php
session_start();
require_once __DIR__ . '/../../models/Article.php';

// Vérification admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$articleModel = new Article();
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: dashboard.php');
    exit;
}

$article = $articleModel->getById($id);
if (!$article) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';
    $auteur = $_POST['auteur'] ?? '';
    $email = $_POST['email'] ?? '';
    $date_publication = $_POST['date_publication'] ?? date('Y-m-d');

    if (!$nom || !$description || !$auteur || !$email) {
        $error = "Tous les champs sont obligatoires";
    } else {
        $updated = $articleModel->update($id, [
            'nom' => $nom,
            'description' => $description,
            'auteur' => $auteur,
            'email' => $email,
            'date_publication' => $date_publication
        ]);
        $success = $updated ? "Article mis à jour avec succès" : "Erreur lors de la mise à jour";
        // Recharger l'article pour afficher les nouvelles valeurs
        $article = $articleModel->getById($id);
    }
}
?>

<h2>Éditer Article</h2>
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST">
    <label>Nom :</label><br>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($article['nom']); ?>" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" required><?php echo htmlspecialchars($article['description']); ?></textarea><br><br>

    <label>Auteur :</label><br>
    <input type="text" name="auteur" value="<?php echo htmlspecialchars($article['auteur']); ?>" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($article['email']); ?>" required><br><br>

    <label>Date de publication :</label><br>
    <input type="date" name="date_publication" value="<?php echo htmlspecialchars($article['date_publication']); ?>"><br><br>

    <button type="submit">Mettre à jour</button>
</form>
<a href="dashboard.php">Retour au dashboard</a>