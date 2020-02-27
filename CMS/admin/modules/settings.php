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

    if(isset($_POST['send'])){
        $tytul = mysqli_real_escape_string($mysqli, $_POST['tytul']);
        $opis = mysqli_real_escape_string($mysqli, $_POST['opis']);
        $slowa = mysqli_real_escape_string($mysqli, $_POST['slowa']);

        modalBox(2, "Ustawienia zapisane poprawnie");
        mysqli_query($mysqli, "UPDATE ustawienia SET wartosc='".$tytul."' WHERE id='1';");
        mysqli_query($mysqli, "UPDATE ustawienia SET wartosc='".$opis."' WHERE id='2';");
        mysqli_query($mysqli, "UPDATE ustawienia SET wartosc='".$slowa."' WHERE id='3';");
    }

    $rows[] = null;
    $i=0;
    $result = mysqli_query($mysqli, "SELECT * FROM ustawienia;");

    while($row = mysqli_fetch_array($result) ) {
        $rows[$i] = $row['wartosc'];
        $i++;
    }
?>
<main>
        <div class="admin-panel_mainhead">
            <h1>Kontroluj ustawienia <strong>swojej</strong> strony</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>USTAWIENIA SYSTEMU CMS</h3>

                    <form action="index.php?page=settings" method="POST" role="form">
                        <legend>Podstawowe informacje o stronie</legend>

                        <div class="form-group">
                            <label for="tytul">Wprowadź tytuł swojej witryny:</label>
                            <input type="text" class="form-control" id="tytul" name="tytul" placeholder="Podaj tytuł strony" value="<?php echo $rows[0]; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="opis">Wprowadź opis strony:</label>
                            <input type="text" class="form-control" id="opis" name="opis" placeholder="Podaj opis strony" value="<?php echo $rows[1]; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="slowa">Wprowadź słowa kluczowe dla wyszukiwarki ston:</label>
                            <input type="text" class="form-control" id="slowa" name="slowa" placeholder="Podaj slowa kluczowe strony" value="<?php echo $rows[2]; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success">ZAPISZ USTAWIENIA</button>
                        <div class="afficite-height"></div>
                        <legend>Wykonaj testy funkcjonalności systemu</legend>
                        <div class="row">
                            <div class="col-lg-6 admin-diagnostic">

                                <button type="button" class="btn btn-info">Test wiadomości mail</button>
                                <button type="button" class="btn btn-info">Benchmark serwera</button>
                                <a href="index.php?page=backupsql" target="_blank"><button type="button" class="btn btn-danger">Wykonaj kopię zapasową bazy danych</button></a>
                                <a href="index.php?page=bigdump" target="_blank"><button type="button" class="btn btn-warning">Import kopii zapasowej bazy danych</button></a>

                            </div>
                            <div class="col-lg-6">
                                <h4>Informacje o serwerze</h4>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Usługa</th>
                                            <th>Stan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PHP</td>
                                            <td>
                                                <p class="green"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MySQL</td>
                                            <td>
                                                <p class="green"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Wersja PHP</td>
                                            <td>
                                                <p><?php echo phpversion(); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Wersja MySQL</td>
                                            <td>
                                                <p>5.2</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>




                    </form>

                </div>
            </div>
        </section>

    </main>
<?php
      

footerAdmin();
}

?>