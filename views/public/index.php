<?php
require_once __DIR__ . '/../../controllers/ArticleController.php';
$controller = new ArticleController();
$articles = $controller->index();
?>
<?php include '../partials/header.php'; ?>
<main class="container">
  <h1>Articles scientifiques</h1>
  <div class="articles">
    <?php foreach ($articles as $a): ?>
      <div class="article">
        <img src="<?= $a['photo'] ?>" alt="">
        <h2><?= htmlspecialchars($a['nom']) ?></h2>
        <p><?= substr(htmlspecialchars($a['description']), 0, 150) ?>...</p>
        <a href="article_detail.php?id=<?= $a['id'] ?>">Lire la suite</a>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<?php include '../partials/footer.php'; ?>