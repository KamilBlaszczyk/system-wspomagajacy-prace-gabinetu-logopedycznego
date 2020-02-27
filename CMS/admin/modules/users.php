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

    headerAdmin(5);

    $users = isset($_GET['us']) ? $_GET['us'] : null;

    switch($users){

        /**
         * 
         * 
         * DODAWANIE NOWEGO UŻYTKOWNIKA
         * 
         * 
         */
        case "add":
        //Odbiór wysłanych wiadomości
        if(isset($_POST['send'])){
            $imie = mysqli_real_escape_string($mysqli, $_POST['imie']);
            $login = mysqli_real_escape_string($mysqli, $_POST['login']);
            $mail = mysqli_real_escape_string($mysqli, $_POST['mail']);
            $passOne = md5($_POST['passFirst']);
            $passTwo = md5($_POST['passSecond']);

            if($passOne==$passTwo){
                modalBox(2, "Użytkownik dodany poprawnie");
                mysqli_query($mysqli, "INSERT INTO admin (login, haslo, imie, mail) VALUES('".$login."', '".$passOne."', '".$imie."', '".$mail."');");
                header("Refresh: 2; URL = index.php?page=users");
            }
            else{
                modalBox(3, "Hasła nie zgadzają się.");
            }
         }

         ?>
    <main>
        <div class="admin-panel_mainhead">
            <h1>Stwórz <strong>nowego</strong> użytkownika</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>UŻYTKOWNICY</h3>

                    <form action="" method="POST" role="form">
                        <legend>Dodaj użytkownika</legend>

                        <div class="form-group">
                            <label for="imie">Imie i nazwisko:</label>
                            <input type="text" class="form-control" id="imie" name="imie" placeholder="Podaj imię i nazwisko" required>
                        </div>

                        <div class="form-group">
                            <label for="imie">Login:</label>
                            <input type="text" class="form-control" id="imie" name="login" placeholder="Podaj login użytkownika" required>
                        </div>

                        <div class="form-group">
                            <label for="mail">Adres email:</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Podaj adres e-mail użytkownika" required>
                        </div>

                        <div class="form-group">
                            <label for="haslo">Wprowadź hasło:</label>
                            <input type="password" class="form-control" id="haslo" name="passFirst" placeholder="Podaj nowe hasło dla użytkownika" required>
                        </div>

                        <div class="form-group">
                            <label for="haslo">Powtórz hasło:</label>
                            <input type="password" class="form-control" id="haslo" name="passSecond" placeholder="Podaj nowe hasło dla użytkownika" required>
                        </div>

                        <legend>Sprawdź poprawność danych, a następnie potwierdź</legend>


                        <button type="submit" name="send" class="btn btn-success">STWÓRZ UŻYTKOWNIKA</button>

                    </form>

                </div>
            </div>
        </section>

    </main>


         <?php
        /**
         * 
         * 
         * EDYTOWANIE OBECNEGO UŻYTKOWNIKA
         * 
         * 
         * 
         */
        break;
        case "edit":

        $id = is_numeric($_GET['id']) ? $_GET['id'] : 1;

        if(isset($_POST['send'])){
            $imie = mysqli_real_escape_string($mysqli, $_POST['imie']);
            $login = mysqli_real_escape_string($mysqli, $_POST['login']);
            $mail = mysqli_real_escape_string($mysqli, $_POST['mail']);
            $passOne = md5($_POST['pass']);

            if(empty($_POST['haslo']))
                mysqli_query($mysqli, "UPDATE admin SET login='".$login."', mail='".$mail."', imie='".$imie."' WHERE id_admin='".$id."';");
            else
                mysqli_query($mysqli, "UPDATE admin SET login='".$login."', mail='".$mail."', imie='".$imie."', haslo='".$passOne."' WHERE id_admin='".$id."';");
            
            modalBox(2, "Użytkownik edytowany pomyślnie");
        }

        $rows[] = null;
        $result = mysqli_query($mysqli, "SELECT * FROM admin WHERE id_admin='".$id."';");

        while($row = mysqli_fetch_array($result) ) {
            $rows[0] = $row['imie'];
            $rows[1] = $row['login'];
            $rows[2] = $row['mail'];
        }
?>
     <main>
        <div class="admin-panel_mainhead">
            <h1>Edytuj <strong>swojego</strong> użytkownika</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>UŻYTKOWNICY</h3>

                    <form action="index.php?page=users&us=edit&id=<?php echo $id; ?>" method="POST" role="form">
                        <legend>Edytuj użytkownika</legend>

                        <div class="form-group">
                            <label for="imie">Imie i nazwisko:</label>
                            <input type="text" class="form-control" id="imie" name="imie" placeholder="Podaj imię i nazwisko" value="<?php echo $rows[0]; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="imie">Login:</label>
                            <input type="text" class="form-control" id="imie" name="login" placeholder="Podaj login użytkownika" value="<?php echo $rows[1]; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="mail">Adres email:</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Podaj adres e-mail użytkownika" value="<?php echo $rows[2]; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="haslo">Nowe hasło (pozostaw puste, w przypadku braku zmian):</label>
                            <input type="password" class="form-control" id="haslo" name="pass" placeholder="Podaj nowe hasło dla użytkownika">
                        </div>

                        <legend>Sprawdź poprawność danych, a następnie potwierdź</legend>


                        <button type="submit" name="send" class="btn btn-success">ZAPISZ ZMIANY</button>

                    </form>

                </div>
            </div>
        </section>

    </main>
<?php
        /**
         * 
         * 
         * 
         * USUWANIE UŻYTKOWNIKA
         * 
         * 
         */
        break;
        case "del":

        $id = is_numeric($_GET['id']) ? $_GET['id'] : 1;
        if($id!=1){
            mysqli_query($mysqli, "DELETE FROM admin WHERE id_admin='".$id."';");
            modalBox(1, "Użytkownik usunięty pomyślnie");
        }
        else
            modalBox(3, "Nie można usunąć głównego administratora");
?>

<main>
        <div class="admin-panel_mainhead">
            <h1>Zarządzaj <strong>swoimi</strong> użytkownikami</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>UŻYTKOWNICY</h3>
                    <a href="index.php?page=users&us=add" class="admin-panel__add-article">
                        <button type="button" class="btn btn-success">DODAJ UŻYTKOWNIKA</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover article-table">
                            <thead>
                                <tr>
                                    <th>Lp.</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Imię i nazwisko</th>
                                    <th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

$result = mysqli_query($mysqli, "SELECT * FROM admin;");

while($row = mysqli_fetch_array($result) ) {
    echo '<tr class="artId_'.$row['id_admin'].'">';
    echo '    <td>'.$row['id_admin'].'</td>';
    echo '    <td>'.$row['login'].'</td>';
    echo '    <td>'.$row['mail'].'</td>';
    echo '    <td>'.$row['imie'].'</td>';
    echo '    <td class="action_width">';
    echo '        <a href="index.php?page=users&us=edit&id='.$row['id_admin'].'">';
    echo '            <button type="button" class="btn btn-primary">EDYTUJ</button>';
    echo '        </a>';
    echo '         <a href="#">';
    echo '            <button type="button" class="btn btn-danger delete-art" data-toggle="modal" href="#modal-id" id="'.$row['id_admin'].'">USUŃ</button>';
    echo '        </a>';
    echo '    </td>';
    echo '</tr>';
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
                                    <h4 class="modal-title">Czy chcesz usunąć użytkownika?</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="idArticle"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                                    <a href="index.php?page=users&us=del&id=" class="delArtUrl"><button type="button" class="btn btn-danger">USUŃ</button></a>
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

        /**
         * 
         * 
         * DOMYŚLNA STRONA
         * 
         * 
         * 
         */

        default:
?>
<main>
        <div class="admin-panel_mainhead">
            <h1>Zarządzaj <strong>swoimi</strong> użytkownikami</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>UŻYTKOWNICY</h3>
                    <a href="index.php?page=users&us=add" class="admin-panel__add-article">
                        <button type="button" class="btn btn-success">DODAJ UŻYTKOWNIKA</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover article-table">
                            <thead>
                                <tr>
                                    <th>Lp.</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Imię i nazwisko</th>
                                    <th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

$result = mysqli_query($mysqli, "SELECT * FROM admin;");

while($row = mysqli_fetch_array($result) ) {
    echo '<tr class="artId_'.$row['id_admin'].'">';
    echo '    <td>'.$row['id_admin'].'</td>';
    echo '    <td>'.$row['login'].'</td>';
    echo '    <td>'.$row['mail'].'</td>';
    echo '    <td>'.$row['imie'].'</td>';
    echo '    <td class="action_width">';
    echo '        <a href="index.php?page=users&us=edit&id='.$row['id_admin'].'">';
    echo '            <button type="button" class="btn btn-primary">EDYTUJ</button>';
    echo '        </a>';
    echo '         <a href="#">';
    echo '            <button type="button" class="btn btn-danger delete-art" data-toggle="modal" href="#modal-id" id="'.$row['id_admin'].'">USUŃ</button>';
    echo '        </a>';
    echo '    </td>';
    echo '</tr>';
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
                                    <h4 class="modal-title">Czy chcesz usunąć użytkownika?</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="idArticle"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                                    <a href="index.php?page=users&us=del&id=" class="delArtUrl"><button type="button" class="btn btn-danger">USUŃ</button></a>
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