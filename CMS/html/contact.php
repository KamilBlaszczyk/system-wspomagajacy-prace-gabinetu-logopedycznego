<?php


require_once("asset/header.php");

headerSite(5);

require_once("admin/modules/functions.php");

if(isset($_POST['send-email'])){
    $imie = $_POST['name'];
    $mail = $_POST['from'];
    $subj = $_POST['subject'];
    $mess = $_POST['message'];

    // modalBox(2, "Wiadomość została wysłana");
}

/**
 * 
 * 
 * 
 * ZROBIĆ MODAL
 * 
 * 
 * 
 */


modalBox(2, "Wiadomość została wysłana");
?>

<div class="container content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="context">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <h2>REJESTRACJA</h2>
                            <form name="email" method="POST" action="index.php?page=contact">
                                <div class="form-group">
                                    <label for="inputName">Imię i nazwisko</label>
                                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Imię i nazwisko" required />
                                </div>
                                <div class="form-group">
                                    <label for="inputMail">Adres e-mail</label>
                                    <input type="email" class="form-control" id="inputMail" name="from" placeholder="Adres e-mail" required />
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject">Temat</label>
                                    <input type="text" class="form-control" id="inputSubject" name="subject" placeholder="Temat" required />
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Wiadomość</label>
                                    <textarea rows="5" id="inputMessage" class="form-control" name="message" placeholder="Wiadomość" required></textarea>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input style="float: left; width: 2%;" type="checkbox" value="1" id="acceptData" class="form-control" name="acceptData" required>
                                        <p style="width:98%; float:right; font-size: 12px;">Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb niezbędnych do realizacji procesu rejestracji (zgodnie z Ustawą z dnia 29.08.1997 roku o Ochronie Danych Osobowych; tekst jednolity: Dz. U. 2016 r. poz. 922). </p>
                                    </label>
                                </div>


                                <!-- antispam field -->
                                <div class="form-group" id="antispam">
                                    <input type="text" name="title" autofill="off" required />
                                </div>
                                <script>
                                    (function() {
                                        var e = document.getElementById("antispam");
                                        e.parentNode.removeChild(e);
                                    })();
                                </script>
                                <!-- /antispam field -->

                                <button type="submit" name="send-email" class="btn btn-danger">Wyślij</button>
                                <button type="reset" name="send-email" class="btn btn-default">Wyczyść</button>
                            </form>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                            <h2>CZĘSTOCHOWA</h2><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2520.114880436184!2d19.117880315745133!3d50.82903597952937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4710b42906117ab5%3A0x64a98d73fd28a4cd!2sExemplar+Mariola+Adamowicz!5e0!3m2!1spl!2spl!4v1501005275907"
                                style="border:0" allowfullscreen="" width="100%" height="540" frameborder="0"></iframe></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php

require_once("asset/footer.php");
?>