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

    headerAdmin(2);

    $art = isset($_GET['art']) ? $_GET['art'] : null;
    
    switch($art){
        /**
         * 
         * 
         * DODAWANIE ARTYKUŁÓW
         * 
         * 
         */
        case "add":

         //Odbiór wysłanych wiadomości
         if(isset($_POST['send'])){
            $tytul = mysqli_real_escape_string($mysqli, $_POST['tytul']);
            $tresc = mysqli_real_escape_string($mysqli, $_POST['tresc']);
            if(!empty($_FILES["fileToUpload"]["name"]))
                $obrazek = upload_image("article", $_FILES["fileToUpload"]);
            else
                $obrazek = null;

            if(!empty($_POST['delImage']) == "delete" || $obrazek == null){
                modalBox(2, "Artykuł dodany poprawnie.");
                mysqli_query($mysqli, "INSERT INTO artykul (tytul, tresc, obrazek) VALUES('".$tytul."', '".$tresc."', 'default.jpg');");
                header("Refresh: 2; URL = index.php?page=article");
            }
            else{
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
                    default:
                        modalBox(2, "Artykuł poprawnie dodany.");
                        mysqli_query($mysqli, "INSERT INTO artykul (tytul, tresc, obrazek) VALUES('".$tytul."', '".$tresc."', '".$obrazek."');");
                        header("Refresh: 2; URL = index.php?page=article");
                    break;
                }
            }
         }
?>
    <main>
        <div class="admin-panel_mainhead">
            <h1>Zarządzaj <strong>swoimi</strong> artykułami</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>ARTYKUŁY</h3>

                    <form action="index.php?page=article&art=add" method="POST" role="form" enctype="multipart/form-data">
                        <legend>Dodaj nowy artykuł</legend>

                        <div class="form-group">
                            <label for="">Tytuł</label>
                            <input type="text" class="form-control" name="tytul" placeholder="Podaj tytuł artykułu">
                        </div>

                        <div class="form-group">
                            <label for="">Treść</label>
                            <textarea name="tresc" id="input${1/(\w+)/\u\1/g}" class="form-control" rows="8" required="required"></textarea>

                        </div>

                        <button type="submit" name="send" class="btn btn-success">UTWÓRZ</button>
                        <label class="btn btn-primary" for="grafika">
                            <input id="grafika" name="fileToUpload" type="file" style="display:none" 
                            onchange="$('#upload-file-info').html(this.files[0].name)">
                            WYBIERZ GRAFIKĘ ARTYKUŁU
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                    </form>


                </div>
            </div>
        </section>

    </main>
<?php
/**
 * 
 * USUWANIE ARTYKUŁÓW
 * 
 * 
 */
            break;
        case "del":
?>
    <main>
        <div class="admin-panel_mainhead">
            <h1>Zarządzaj <strong>swoimi</strong> artykułami</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>ARTYKUŁY</h3>
                    <a href="#" class="admin-panel__add-article">
                        <button type="button" class="btn btn-success">DODAJ ARTYKUŁ</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover article-table">
                            <thead>
                                <tr>
                                    <th>Lp.</th>
                                    <th>Tytuł</th>
                                    <th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

$result = mysqli_query($mysqli, "SELECT * FROM artykul;");

while($row = mysqli_fetch_array($result) ) {
    echo '<tr class="artId_'.$row['id'].'">';
    echo "<td>" . $row['id'] . "</td>";  
    echo "<td>" . $row['tytul'] . "</td>";
    echo '<td class="action_width">';
    echo '<a href="/article.php?id='.$row['id'].'">';
    echo '<button type="button" class="btn btn-success">PODGLĄD</button></a>';
    echo '<a href="index.php?page=article&art=edit&id='.$row['id'].'">';
    echo '<button type="button" class="btn btn-primary">EDYTUJ</button></a>';
    echo '<a href="#">';
    echo '<button type="button" class="btn btn-danger delete-art"  data-toggle="modal" href="#modal-id" id="'.$row['id'].'">USUŃ</button></a>';
    echo "</td></tr>";
    //data-addr="index.php?page=article&art=del&id='.$row['id'].'"
    }

?>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Czy chcesz usunąć artykuł?</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="idArticle"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                                    <button type="button" class="btn btn-danger">USUŃ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php
            modalBox(1, "Poprawnie usunięto artykuł.");
            break;
        case "edit":
        /**
         * 
         * 
         * EDYTOWANIE ARTYKUŁÓW
         * 
         * 
         * 
         */
        $id = is_numeric($_GET['id']) ? $_GET['id'] : 1;

         //Odbiór wysłanych wiadomości
         if(isset($_POST['send'])){
            $tytul = mysqli_real_escape_string($mysqli, $_POST['tytul']);
            $tresc = mysqli_real_escape_string($mysqli, $_POST['tresc']);
            if(!empty($_FILES["fileToUpload"]["name"]))
                $obrazek = upload_image("article", $_FILES["fileToUpload"]);
            else
                $obrazek = null;

            if(!empty($_POST['delImage']) == "delete"){
                modalBox(2, "Artykuł poprawnie edytowany.");
                mysqli_query($mysqli, "UPDATE artykul SET tytul='".$tytul."', tresc='".$tresc."', obrazek='default.jpg' WHERE id='".$id."';");
            }
            elseif($obrazek == null){
                modalBox(2, "Artykuł poprawnie edytowany.");
                mysqli_query($mysqli, "UPDATE artykul SET tytul='".$tytul."', tresc='".$tresc."' WHERE id='".$id."';");
            }
            else{
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
                    default:
                        modalBox(2, "Artykuł poprawnie edytowany.");
                        mysqli_query($mysqli, "UPDATE artykul SET tytul='".$tytul."', tresc='".$tresc."', obrazek='".$obrazek."' WHERE id='".$id."';");
                    break;
                }
            }
         }

        $rows[] = null;
        $result = mysqli_query($mysqli, "SELECT * FROM artykul WHERE id='".$id."';");

        while($row = mysqli_fetch_array($result) ) {
            $rows[0] = $row['tytul'];
            $rows[1] = $row['tresc'];
        }
        
?>
    <main>
        <div class="admin-panel_mainhead">
            <h1>Edytuj <strong>swoje</strong> artykuły</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>ARTYKUŁY</h3>

                    <form action="index.php?page=article&art=edit&id=<?php echo $id; ?>" method="POST" role="form" enctype="multipart/form-data">
                        <legend>Edytuj artykuł</legend>

                        <div class="form-group">
                            <label for="">Tytuł</label>
                            <input type="text" class="form-control" name="tytul" placeholder="Podaj tytuł artykułu" value="<?php echo $rows[0]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Treść</label>
                            <textarea name="tresc" id="input${1/(\w+)/\u\1/g}" class="form-control" rows="8" required="required"><?php echo $rows[1]; ?></textarea>

                        </div>

                        <button type="submit" name="send" class="btn btn-success">ZAPISZ</button>
                        <label class="btn btn-primary" for="grafika">
                            <input id="grafika" name="fileToUpload" type="file" style="display:none" 
                            onchange="$('#upload-file-info').html(this.files[0].name)">
                            NADPISZ GRAFIKĘ ARTYKUŁU
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="delImage" value="delete">
                                Zaznacz, aby usunąć zdjęcie do artykułu
                            </label>
                        </div>

                    </form>

                </div>
            </div>
        </section>

    </main>
<?php
            break;
        
            //Domyślna strona
        default:
?>
<main>
        <div class="admin-panel_mainhead">
            <h1>Zarządzaj <strong>swoimi</strong> artykułami</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>ARTYKUŁY</h3>
                    <a href="index.php?page=article&art=add" class="admin-panel__add-article">
                        <button type="button" class="btn btn-success">DODAJ ARTYKUŁ</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover article-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tytuł</th>
                                    <th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody>
<?php

$result = mysqli_query($mysqli, "SELECT * FROM artykul;");

while($row = mysqli_fetch_array($result) ) {
    echo '<tr class="artId_'.$row['id'].'">';
    echo "<td>" . $row['id'] . "</td>";  
    echo "<td>" . $row['tytul'] . "</td>";
    echo '<td class="action_width">';
    echo '<a href="/article.php?id='.$row['id'].'">';
    echo '<button type="button" class="btn btn-success">PODGLĄD</button></a>';
    echo '<a href="index.php?page=article&art=edit&id='.$row['id'].'">';
    echo '<button type="button" class="btn btn-primary">EDYTUJ</button></a>';
    echo '<a href="#">';
    echo '<button type="button" class="btn btn-danger delete-art"  data-toggle="modal" href="#modal-id" id="'.$row['id'].'">USUŃ</button></a>';
    echo "</td></tr>";
    //data-addr="index.php?page=article&art=del&id='.$row['id'].'"
    }

?>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Czy chcesz usunąć artykuł?</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="idArticle"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                                    <a href="index.php?page=article&art=del&id=" class="delArtUrl"><button type="button" class="btn btn-danger">USUŃ</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php
        break;
    }

footerAdmin();
}

?>