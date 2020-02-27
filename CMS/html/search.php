<?php


require_once("asset/header.php");
require_once("asset/sqlQuery.php");
headerSite(3);

if(isset($_POST['send'])){
    $search = $_POST['search'];


    $art = getArticleByContent($search);
?>

    <div class="container content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="context">
                    <?php echo $art; ?>
                </div>
            </div>
        </div>
    </div>

   <?php
}
else{
    header("Location: index.php?page=index");
}
require_once("asset/footer.php");
?>