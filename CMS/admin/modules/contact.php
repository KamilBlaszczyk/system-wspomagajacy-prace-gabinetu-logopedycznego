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

    headerAdmin(4);

    if(isset($_POST['send'])){
        $tel = mysqli_real_escape_string($mysqli, $_POST['numer']);
        $adr = mysqli_real_escape_string($mysqli, $_POST['adres']);
        $mail = mysqli_real_escape_string($mysqli, $_POST['mail']);

        modalBox(2, "Dane kontaktowe zmienione poprawnie");
        mysqli_query($mysqli, "UPDATE kontakt SET opcja='".$tel."' WHERE id='1';");
        mysqli_query($mysqli, "UPDATE kontakt SET opcja='".$adr."' WHERE id='2';");
        mysqli_query($mysqli, "UPDATE kontakt SET opcja='".$mail."' WHERE id='3';");
    }

    $rows[] = null;
    $i = 0;
    $result = mysqli_query($mysqli, "SELECT * FROM kontakt;");

    while($row = mysqli_fetch_array($result) ) {
        $rows[$i] = $row['opcja'];
        $i++;
    }

?>
    <main>
        <div class="admin-panel_mainhead">
            <h1>Ułatw kontakt <strong>swoimi</strong> klientom</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>KONTAKT</h3>

                    <form action="index.php?page=contact" method="POST" role="form">
                        <legend>Numer telefonu na stronie</legend>
                        <div class="form-group">
                            <label for="numer">Podaj numer telefonu</label>
                            <input type="tel" name="numer" class="form-control" id="numer" placeholder="Np. (22) 345 45 45" required="required" value="<?php echo $rows[0]; ?>">
                        </div>

                        <legend>Adres twojej siedziby</legend>
                        <div class="form-group">
                            <label for="adrress">Podaj adres</label>
                            <textarea name="adres" id="adrress" class="form-control admin-panel_address" rows="4" required="required"><?php echo $rows[1]; ?></textarea>
                        </div>

                        <legend>Adres poczty elektronicznej</legend>
                        <div class="form-group">
                            <label for="email">Podaj adres e-mail do kontaktu</label>
                            <input type="email" name="mail" id="email" class="form-control" required="required" title="" value="<?php echo $rows[2]; ?>">
                        </div>



                        <button type="submit" name="send" class="btn btn-primary">ZAPISZ</button>
                    </form>

                </div>
            </div>
        </section>

    </main>
<?php

    footerAdmin();
}

?>