<?php

require_once "asset/sqlQuery.php";

?>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 footer-adr-bg">
                    <h3>ADRES SIEDZIBY</h3>
                    <div class="line"></div>
                    <p><?php echo getShort(1, "kontakt", "opcja"); ?></p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 footer-bg-img">
                    <div class="afficite-left">
                        <h3>SZYBKI KONTAKT</h3>
                        <div class="line ln-white"></div>
                        <div class="phone">
                            <span class="glyphicon glyphicon-earphone"></span>
                            <p><?php echo getShort(1, "kontakt", "opcja"); ?></p>
                        </div>
                        <div class="mail">
                            <a href="mailto:<?php echo getShort(3, "kontakt", "opcja"); ?>"><span class="glyphicon glyphicon-envelope"></span>
							<p><?php echo getShort(3, "kontakt", "opcja"); ?></p></a>
                        </div>
                        <div class="fb">
                            <a href="https://www.facebook.com/" target="_blank"><img src="images/fb.png" class="img-responsive">
                                <p>fb.com/pracownialogopedy</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm col-xs-12 footer-bg">
                    <h3>CZYM SIĘ ZAJMUJEMY?</h3>
                    <div class="line ln-white"></div>
                    <ul>
                        <li class="">
                            <a href="#">Elektrostymulacja podniebienia i języka</a>
                        </li>
                        <li class="">
                            <a href="#">Konsultacje i diagnostyka logopedyczna</a>
                        </li>
                        <li class="">
                            <a href="#">Terapia zaburzeń mowy i komunikacji</a>
                        </li>
                        <li class="">
                            <a href="#">Terapia wad wymowy</a>
                        </li>
                        <li class="">
                            <a href="#">Terapia afazji mowy i dyzartrii</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-author hidden-sm">
                <p>Copyright 2018 &copy; podniebienie.pl. Wszelkie prawa zastrzeżone.  </p>
            </div>
        </div>
    </footer>
    <!--<div class="landscape">
		<h3>Obróć ekran, aby strona działała poprawnie</h3>
	</div>-->
    <script>
        $('.carousel').carousel({
            interval: 5000,
            pause: null
        });
//Auto show modal on load page
$(window).on('load', function() {
    $('#infoModal').modal('show');
});
    </script>
    <script async src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>
