<?php
session_start();
require "config.php";
require "modules/functions.php";

$levelInfo = 0;

if(isset($_GET['logout'])){
	session_destroy();
	$_SESSION['logout'] = true;
	$levelInfo = 3;
}

if(isset($_SESSION['logged']) AND $_SESSION['logged'] == true AND $_SESSION['logout'] != true){
	header("Location: index.php?page=page");
}
else{
	$_SESSION['logged'] = false;
}

if(isset($_POST['send'])){
	$login = $_POST['login'];
	$haslo = md5($_POST['haslo']);

	$sql = "SELECT * FROM admin WHERE haslo='$haslo' AND login='$login';";
	if (!$result = $mysqli->query($sql)) {
		echo "Error: Blad wykonywania zapytania: \n";
		echo "Query: " . $sql . "\n";
		echo "Errno: " . $mysqli->errno . "\n";
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}
	else{
		if($result->num_rows>=1){
			$levelInfo = 1;
			$_SESSION['logged'] = true;
			header("Refresh: 2; URL = index.php?page=page");
		}
		else{
			$levelInfo = 2;
		}
	}

}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PANEL ADMINISTRATORA</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <main class="container">
        <div class="admin-panel__login">

            <div class="row">
				<?php
					if($levelInfo != 0){
						switch($levelInfo){
							case 1:
								alertLoginBox(1, "Zalogowano poprawnie!");
								break;
							case 2:
								alertLoginBox(2, "Błędne hasło lub login. Spróbuj ponownie");
								break;
							case 3:
								alertLoginBox(3, "Wylogowano poprawnie!");
								break;
						}
					}
				?>
				<div class="col-lg-4 col-md-4 col-md-offset-4 col-lg-offset-4 admin-bg__login">
                    <div class="col-lg-12 admin-top__login">
                        <h1>PANEL ADMINISTRATORA</h1>
                    </div>
                    <form action="index.php?page=login" method="POST" class="form-inline">
                        <div class="col-lg-6 col-md-8 col-md-offset-2 col-lg-offset-3">

                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Login</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input type="text" name="login" class="form-control" id="exampleInputAmount" placeholder="Login">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Pass</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                    <input type="password" name="haslo" class="form-control" id="exampleInputAmount" placeholder="Hasło">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12">
                            <input type="submit" name="send" class="btn btn-success admin-padding__login" value="ZALOGUJ SIĘ">
                        </div>
                    </form>
                </div>

    </main>

    <script defer src="js/jquery.min.js"></script>
    <script defer src="js/bootstrap.min.js"></script>
</body>

</html>