
<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/article.php";
require_once __DIR__ . "/templates/header.php";


if (isset($_GET['page'])) {
  $page = (int)$_GET['page'];

} else {
  $page = 1;
}
$articles = getArticles($pdo, _ADMIN_ITEM_PER_PAGE_, $page);

$totalArticles = getTotalArticles($pdo);

$totalPages = ceil($totalArticles / _ADMIN_ITEM_PER_PAGE_);

?>

<!-- @todo coder la boucle foreach pour afficher les articles -->


<h1 class="display-5 fw-bold text-body-emphasis">Articles</h1>
<div class="d-flex gap-2 justify-content-left py-5">
  <a class="btn btn-primary d-inline-flex align-items-left" href="article.php">
    Ajouter un article
  </a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <!-- <tr>
      <th scope="row">52</th>
      <td>Les meilleurs outils DevOps</td>
      <td><a href="article.php?id=52">Modifier</a>
        | <a href="article_delete.php?id=52" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
    </tr>
    <tr>
      <th scope="row">51</th>
      <td>React Natives : Quelles différences par rapport à React</td>
      <td><a href="article.php?id=51">Modifier</a>
        | <a href="article_delete.php?id=51" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
    </tr>
    <tr>
      <th scope="row">50</th>
      <td>PHP ou Python ?</td>
      <td><a href="article.php?id=50">Modifier</a>
        | <a href="article_delete.php?id=50" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
    </tr>
    <tr>
      <th scope="row">49</th>
      <td>Article 49</td>
      <td><a href="article.php?id=49">Modifier</a>
        | <a href="article_delete.php?id=49" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
    </tr>-->

<?php

function compareIdsDesc($a, $b) {
    return $b["id"] - $a["id"];
}

usort($articles, 'compareIdsDesc');
foreach ($articles as $article) {
    ?>
    <tr>
        <th scope="row"><?= $article["id"]; ?></th>
        <td><?= $article["title"]; ?></td>
        <td><a href="article.php?id=<?= $article["id"] ?>">Modifier</a> | <a href="article_delete.php?id=<?= $article["id"] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a></td>
    </tr>
    <?php
}
?>

  


  </tbody>
</table>

<!-- @todo coder la boucle foreach pour gérer les pages -->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php foreach (range(1, $totalPages) as $i) : ?>
      <li class="page-item">
      <a class=" <?= $page == $i? " page-link active": "page-link"; ?>" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>



<?php require_once __DIR__ . "/templates/footer.php"; ?>