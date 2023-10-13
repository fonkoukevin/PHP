<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/templates/header.php";

// Récupérer l'ID de l'article à partir de la requête GET
if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];
    $article = getArticleById($pdo, $articleId);

    if ($article) {
        // L'article a été trouvé, vous pouvez maintenant afficher ses détails
?>

        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="<?= $article['image'] != null ? '/uploads/articles/' . $article['image'] : '/assets/images/default-article.jpg'; ?>" class="d-block mx-lg-auto img-fluid" alt="<?= $article['title']; ?>" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= $article['title']; ?></h1>
                <p class="lead"><?= $article['content']; ?></p>
            </div>
        </div>

<?php
    } else { ?>
        
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="/uploads/articles/3-devops.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Les meilleurs outils DevOps</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, amet. Cum labore possimus ad vitae minima nesciunt commodi eos.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, amet. Cum labore possimus ad vitae minima nesciunt commodi eos.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, amet. Cum labore possimus ad vitae minima nesciunt commodi eos.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, amet. Cum labore possimus ad vitae minima nesciunt commodi eos.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, amet. Cum labore possimus ad vitae minima nesciunt commodi eos.</p>
    </div>
</div>


  <?php } }

require_once __DIR__ . "/templates/footer.php";
?>