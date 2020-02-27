<?php

error_reporting("E_ALL");

require "asset/sqlQuery.php";

function headerSite($num){
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo getShort(1, "ustawienia", "wartosc"); ?></title>
    <meta name="description" content="<?php echo getShort(2, "ustawienia", "wartosc"); ?>">
    <meta name="keywords" content="<?php echo getShort(3, "ustawienia", "wartosc"); ?>">
    <meta name="theme-color" content="#4285f4">
    <meta name="msapplication-navbutton-color" content="#4285f4">
    <meta name="apple-mobile-web-app-status-bar-style" content="#4285f4">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/media.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript" charset="utf-8" async></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/56fa629212.css">
    <meta name="generator" content="Batflat" />
    <link rel="stylesheet" href="css/lightbox.min.css">
    <script src="js/lightbox.min.js"></script>
</head>

<body>
<header>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs logo-header"><img src="images/logo.png"></div>
                <div class="col-lg-3 col-md-2 hidden-sm hidden-xs header-bg">
                    <form action="index.php?page=search" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control search" name="search" placeholder="Wyszukaj" required>
                            <button type="submit" class="btn btn-primary" name="send" style="margin-top: 20px;"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
                                <a class="navbar-brand hidden-lg hidden-md" href="#"><img src="images/exemplar-bl.png" class="img-responsive"></a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class=" <?php echo ($num == 1) ? 'active' : "";  ?>">
                                        <a href="index.php?page=index">Strona Główna</a>
                                    </li>
                                    <li class="dropdown  <?php echo ($num == 2) ? 'active' : "";  ?>">
                                        <a href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">O nas<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="index.php?page=co-robimy">Co robimy?</a></li>
                                            <li><a href="index.php?page=wspolpracujemy-z---">Współpracujemy z...</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown <?php echo ($num == 3) ? 'active' : "";  ?>">
                                        <a href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Oferta<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <?php
                                                global $mysqli;
                                                $i = 1;
                                                $result = $mysqli->query("SELECT * FROM artykul;");
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<li><a href="index.php?page=article&id='.$row['id'].'">'.$row['tytul'].'</a></li>';
                                                    $i++;
                                                }
                                            ?>
                                        </ul>
                                    </li>
                                    <li class=" <?php echo ($num == 4) ? 'active' : "";  ?>">
                                        <a href="index.php?page=gallery">Galeria</a>
                                    </li>
                                    <li class=" <?php echo ($num == 5) ? 'active' : "";  ?>">
                                        <a href="index.php?page=contact">Kontakt</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
        <div class="content-float-box-top hidden"></div>
    </header>


    <?php
}
?>
