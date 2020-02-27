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
        $temat = $_POST['temat'];
        $wiadomosc = $_POST['tresc']."-------------\n\nFormularz wysłany ze storny: ".$_SERVER['HTTP_REFERER'];
        $header = "Content-type: text/plain; charset=UTF-8;";

        if(mail("snaffx@wp.pl",$temat,$wiadomosc,$header)){
            modalBox(2, "Wiadomość została wysłana.");
        }
        else{
            modalBox(3, "Wiadomość nie została wysłana. Spróbuj ponownie.");
        } 
    }
?>
    <main>
        <div class="admin-panel_mainhead">
            <h1>Skontaktuj się <strong>ze mną</strong> w przypadku problemów</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 admin-panel__article">
                    <h3>KONTAKT Z SUPPORTEM</h3>

                    <div class="row">
                        <div class="col-lg-6">
                            <form action="index.php?page=support" method="POST" role="form">
                                <legend>Formularz kontaktowy</legend>

                                <div class="form-group">
                                    <label for="temat">Temat problemu</label>
                                    <input type="text" name="temat" class="form-control" id="temat" placeholder="Wpisz temat twojego problemu">
                                </div>

                                <div class="form-group">
                                    <label for="tresc">Opisz swój problem możliwie dokładnie</label>
                                    <textarea name="tresc" id="tresc" class="form-control" rows="3" required="required"></textarea>
                                </div>

                                <button type="submit" name="send" class="btn btn-primary">Wyślij</button>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <legend>Kontakt bezpośredni</legend>
                            <address>
                            <h4>Mateusz Bartelik</h4>
                            <p>tel. <strong>792 692 947</strong></p>
                            <p>email: <strong>mateusz.bartelik@wp.eu</strong></p>
                            <p>Adres:</p>
                            <p>ul. Słoneczna 1/1</p>
                            <p>77-133 Tuchomie</p>
                        </address>
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