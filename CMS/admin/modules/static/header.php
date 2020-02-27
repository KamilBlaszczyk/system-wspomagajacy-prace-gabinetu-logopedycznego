<?php

function headerAdmin($num){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PANEL ADMINISTRATORA</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <header class="admin-panel__main">

        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li <?php echo ($num == 1) ? 'class="active"' : "";  ?> ><a href="index.php?page=page">STRONA GŁÓWNA</a></li>
                    <li <?php echo ($num == 2) ? 'class="active"' : "";  ?> ><a href="index.php?page=article">ARTYKUŁY</a></li>
                    <li <?php echo ($num == 3) ? 'class="active"' : "";  ?> ><a href="index.php?page=gallery">GALERIA</a></li>
                    <li <?php echo ($num == 4) ? 'class="active"' : "";  ?> ><a href="index.php?page=contact">KONTAKT</a></li>
                    <li class="dropdown <?php echo ($num == 5) ? 'active' : ""; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">USTAWIENIA <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?page=settings">USTAWIENIA SYSTEMU</a></li>
                            <li><a href="index.php?page=users">UŻYTKOWNICY</a></li>
                            <li><a href="index.php?page=support">SUPPORT</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php?page=login&logout"><span class="glyphicon glyphicon-off"></span> Wyloguj się</a></li>
                    <li><a href="/" target="_blank"><span class="glyphicon glyphicon-home"></span> Strona główna</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

    </header>

<?php
}

?>