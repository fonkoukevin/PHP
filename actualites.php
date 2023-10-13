<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/templates/header.php";


$articles = getArticles($pdo);


if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}


$articlesPerPage = _ADMIN_ITEM_PER_PAGE_;


$totalArticles = getTotalArticles($pdo);


$totalPages = ceil($totalArticles / $articlesPerPage);


function compareIdsDesc($a, $b) {
    return $b["id"] - $a["id"];
}

usort($articles, 'compareIdsDesc');


$startIndex = ($page - 1) * $articlesPerPage;


$articlesToDisplay = array_slice($articles, $startIndex, $articlesPerPage);

?>

<h1>TechTrendz Actualités</h1>

<div class="row text-center">
    <?php foreach ($articlesToDisplay as $article) : ?>
        <div class="col-md-4 my-2 d-flex">
            <div class="card">
                <img src="<?= $article['image'] != null ? '/uploads/articles/' . $article['image'] : '/assets/images/default-article.jpg'; ?>" class="card-img-top" alt="<?= $article['title']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $article['title']; ?></h5>
                    <a href="actualite.php?id=<?= $article['id']; ?>" class="btn btn-primary">Lire la suite</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php foreach (range(1, $totalPages) as $i) : ?>
      <li class="page-item">
        <a class="<?= $page == $i ? "page-link active" : "page-link"; ?>" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
