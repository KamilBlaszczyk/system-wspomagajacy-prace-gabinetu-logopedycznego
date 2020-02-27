<?php


require_once("asset/header.php");
require_once("asset/sqlQuery.php");
headerSite(3);

$art = getArticleById($_GET['id']);
$img = getImageArticle($_GET['id']);
?>

    <div class="container content">
        <div class="row">
            <div class="col-lg-5 col-md-4 col-sm-12 hidden-xs">
                <img src="galleries/article/<?php echo $img;?>" class="img-responsive fixes">
            </div>
            <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
                <div class="context">
                    <?php echo $art; ?>
                </div>
            </div>
        </div>
    </div>

   <?php

require_once("asset/footer.php");
?>