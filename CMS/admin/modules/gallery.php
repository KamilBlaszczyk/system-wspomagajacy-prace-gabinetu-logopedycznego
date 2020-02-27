<?php
session_start();
require "config.php";

if(!isset($_SESSION['logged'])){
	header("Location: index.php?page=login");
}
else{
	require 'modules/static/header.php';
    require 'modules/static/footer.php';
    require 'modules/functions.php';

    headerAdmin(3);

    //Dodawanie zdjęć do galerii
    if(isset($_POST['send'])){
        //Odbiór wysłanych obrazkow
        if(!empty($_FILES["fileToUpload"]["name"]))
            $obrazek = upload_image("gallery", $_FILES["fileToUpload"]);
        else
            $obrazek = null;

        switch($obrazek){
            case 1:
                modalBox(3, "System odebrał pusty obrazek. Spróbuj ponownie");
            break;
            case 2:
                modalBox(3, "Podany format pliku jest nieprawidłowy. Spróbuj ponownie");
            break;
            case 3:
                modalBox(3, "Wystąpił nieznany błąd. Spróbuj ponownie");
            break;
            case null:
                modalBox(3, "Nie wybrano obrazka. Spróbuj ponownie");
            break;
            default:
                modalBox(2, "Obrazek poprawnie dodany.");
                mysqli_query($mysqli, "INSERT INTO zdjecia (sciezka) VALUES('".$obrazek."');");
            break;
        }
    }

    //Usuwanie zdjęć z galerii
    if(!empty($_GET['gal']) == "del"){
        if(isset($_GET['id'])){
            $id = is_numeric($_GET['id']) ? $_GET['id'] : 0;
            modalBox(1, "Obrazek poprawnie usunięty.");
            $result = mysqli_query($mysqli, "SELECT sciezka FROM zdjecia WHERE id_zdj='".$id."'");
            $row = mysqli_fetch_assoc($result);

            mysqli_query($mysqli, "DELETE FROM zdjecia WHERE id_zdj='".$id."' AND sciezka='".$row['sciezka']."'");
            delFile("../galleries/gallery/".$row['sciezka']);
        }
    }
?>

    <main>
        <div class="admin-panel_mainhead">
            <h1>Przygotuj <strong>swoje</strong> zdjęcia na stornę</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>GALERIA</h3>
                    <form action="index.php?page=gallery&gal=add" method="POST" role="form" enctype="multipart/form-data">
                        <legend>Dodaj zdjęcie</legend>
                        <label class="btn btn-primary" for="grafika">
                            <input id="grafika" name="fileToUpload" type="file" style="display:none" 
                            onchange="$('#upload-file-info').html(this.files[0].name)">
                            WYBIERZ ZDJĘCIE
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                        <br><br>
                        <input type="submit" value="WYŚLIJ" name="send" class="btn btn-success">
                    </form>
                    <div class="admin-gallery">
                        <legend>Przeglądaj galerię</legend>
                        <div class="row">

                        <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM zdjecia;");
                    
                        while($row = mysqli_fetch_array($result) ) {
                            echo '<div class="col-lg-4">';
                            echo '<img src="../galleries/gallery/'.$row['sciezka'].'" class="img-thumbnail">';
                            echo '<a href="index.php?page=gallery&gal=del&id='.$row['id_zdj'].'"><button type="button" class="btn btn-danger" style="width: 100%; margin-top: 10px; border-radius: 0px;">USUŃ</button></a>';
                            echo '</div>';
                        }

                        ?>
                            <!-- <div class="col-lg-4">
                                <img src="images/gallery/5.JPG" class="img-thumbnail">
                                <a href="index.php?page=gallery&gal=del&id="><button type="button" class="btn btn-danger" style="width: 100%; margin-top: 10px; border-radius: 0px;">USUŃ</button></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php

    footerAdmin();
}

?>