<?php

require_once("asset/header.php");

headerSite(1);
?>
<div id="carousel-generic" class="carousel slide hidden-xs" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-generic" data-slide-to="1"></li>
            <li data-target="#carousel-generic" data-slide-to="2"></li>
            <li data-target="#carousel-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/slides/1.jpg" alt="Slajd 1" class="img-responsive">
                <div class="carousel-caption">
                    <h3>ELEKTROSTYMULACJA</h3>
                    <hr>
                    <p>PODNIEBIENIA I JĘZYKA</p>
                </div>
            </div>
            <div class="item">
                <img src="images/slides/2.jpg" alt="Slajd 1" class="img-responsive">
                <div class="carousel-caption">
                    <h3>MARIOLA I BOGUSŁAW</h3>
                    <hr>
                    <p>GABINET LOGOPEDYCZNY</p>
                </div>
            </div>
            <div class="item">
                <img src="images/slides/3.jpg" alt="Slajd 1" class="img-responsive">
                <div class="carousel-caption">
                    <h3>PRACA Z NAJMŁODSZYMI</h3>
                    <hr>
                    <p>BOGATE DOŚWIADCZENIE</p>
                </div>
            </div>
            <div class="item">
                <img src="images/slides/4.jpg" alt="Slajd 1" class="img-responsive">
                <div class="carousel-caption">
                    <h3>GABINET PRZYJAZNY</h3>
                    <hr>
                    <p>DLA DZIECI I RODZICÓW</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
            <img src="images/arrow_left.png">
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
            <img src="images/arrow_right.png">
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="affmain-page"></div>

    <?php

require_once("asset/footer.php");
?>