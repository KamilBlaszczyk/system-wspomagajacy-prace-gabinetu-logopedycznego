<?php

$db_server   = 'localhost:3307';
$db_name     = 'suslow';
$db_username = 'suslow';
$db_password = 'suslow';

$mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);

if ($mysqli->connect_errno) {

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Nie mozna polaczyc sie z baza danych \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    // You might want to show them something nice, but we will simply exit
    exit;
}

if (!$mysqli->set_charset("utf8")) {
    printf("Error: Nie można ustawić kodowania UTF-8: %s\n", $mysqli->error);
    exit();
}

