<?php
session_start();

if(!isset($_SESSION['logged'])){
	header("Location: index.php?page=login");
}
else{
	require 'modules/static/header.php';
	require 'modules/static/footer.php';

	headerAdmin(1);
?>
	<main>
        <div class="admin-panel_mainhead">
            <h1>Spersonalizuj <strong>swoją</strong> witrynę</h1>
        </div>
        <section class="container admin-panel_box">
            <div class="row">
                <a href="index.php?page=article" class="outerspace">
                    <div class="col-lg-2 col-lg-offset-1 image-margin-hover">

                        <figure>
                            <img src="images/article.png" class="img-responsive">
                            <figcaption>
                                <h2>ARTYKUŁY</h2>
                                <div class="line"></div>
                                <p>Tutaj edytujesz artykuły na stronie</p>
                            </figcaption>
                        </figure>

                    </div>
                </a>
                <a href="index.php?page=gallery" class="outerspace">
                    <div class="col-lg-2 col-lg-offset-2 image-margin-hover">

                        <figure>
                            <img src="images/gallery.png" class="img-responsive">
                            <figcaption>
                                <h2>GALERIA</h2>
                                <div class="line"></div>
                                <p>W tym miejscu możesz zarządzać galerią strony</p>
                            </figcaption>
                        </figure>

                    </div>
                </a>
                <a href="index.php?page=contact" class="outerspace">
                    <div class="col-lg-2 col-lg-offset-2 image-margin-hover">

                        <figure>
                            <img src="images/contact.png" class="img-responsive">
                            <figcaption>
                                <h2>KONTAKT</h2>
                                <div class="line"></div>
                                <p>Edytuj swoje dane kontaktowe na stronie</p>
                            </figcaption>
                        </figure>

                    </div>
                </a>
            </div>
        </section>

        <section class="container admin-panel_box">
            <div class="row">
                <a href="index.php?page=users" class="outerspace">
                    <div class="col-lg-2 col-lg-offset-1 image-margin-hover">

                        <figure>
                            <img src="images/users.png" class="img-responsive">
                            <figcaption>
                                <h2>UŻYTKOWNICY</h2>
                                <div class="line"></div>
                                <p>Zarządzaj użytkownikami panelu administratora</p>
                            </figcaption>
                        </figure>

                    </div>
                </a>
                <a href="index.php?page=settings" class="outerspace">
                    <div class="col-lg-2 col-lg-offset-2  image-margin-hover">

                        <figure>
                            <img src="images/settings.png" class="img-responsive">
                            <figcaption>
                                <h2>USTAWIENIA</h2>
                                <div class="line"></div>
                                <p>Kontroluj ustawienia systemu CMS</p>
                            </figcaption>
                        </figure>

                    </div>
                </a>
                <a href="index.php?page=suport" class="outerspace">
                    <div class="col-lg-2 col-lg-offset-2 image-margin-hover">

                        <figure>
                            <img src="images/support.png" class="img-responsive">
                            <figcaption>
                                <h2>SUPPORT</h2>
                                <div class="line"></div>
                                <p>Problem ze stroną? Sprawdź gdzie mnie szukać</p>
                            </figcaption>
                        </figure>

                    </div>
                </a>
            </div>
        </section>
    </main>
<?php

	footerAdmin();
}

?>