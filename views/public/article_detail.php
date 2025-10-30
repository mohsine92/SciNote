<?php
require_once __DIR__ . '/../../controllers/ArticleController.php';
$controller = new ArticleController();
$article = $controller->show($_GET['id']);
?>
<?php include '../partials/header.php'; ?>
<main class="container">
  <h1><?= htmlspecialchars($article['nom']) ?></h1>
  <img src="<?= $article['photo'] ?>" alt="">
  <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>
  <p>Auteur : <?= htmlspecialchars($article['auteur']) ?></p>
  <p>Date de publication : <?= $article['date_publication'] ?></p>
</main>
<?php include '../partials/footer.php'; ?>