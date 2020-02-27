<?php


require_once("asset/header.php");
require_once("asset/sqlQuery.php");
headerSite(4);

$gallery = returnArrayGallery();
?>

<div class="container content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="context">
                    <h3>Gabinet logopedyczny<br></h3>
                    <div class="line"></div>
                    <p>
                        <div class="row">
                            <div class="gallery">
                                <?php for($i=0; $i<count($gallery); $i++){
                                        echo '<div class="col-md-4 col-sm-6">';
                                        echo '<div class="thumbnail">';
                                        echo '<a href="galleries/gallery/'.$gallery[$i].'" class="gallery-gabinet"><img src="galleries/gallery/'.$gallery[$i].'" alt="" class="img-responsive"></a>';
                                        echo '</div></div>';
                                } ?>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('.gallery-gabinet').lightbox();
                            });
                        </script><br></p>
                    <p><br></p>
                </div>
            </div>
        </div>
    </div>

   <?php

require_once("asset/footer.php");
?>