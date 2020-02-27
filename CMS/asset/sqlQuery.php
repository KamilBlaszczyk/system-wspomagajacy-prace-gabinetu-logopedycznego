<?php

require "admin/config.php";

function getShort($id, $what, $tabName){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM $what WHERE id='$id';");
    while($row = $result->fetch_assoc()) {
        return $row[$tabName];
    }
}

function returnArrayGallery(){
    global $mysqli;
    $arr = null;
    $i = 0;

    $query = "SELECT * FROM zdjecia;";

    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $arr[$i] = $row['sciezka'];
            $i++;
        }
    }
    return $arr;
}

function getArticleById($id){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM artykul WHERE id='$id';");
    while($row = $result->fetch_assoc()) {
        $tytul = $row['tytul'];
        $tresc = $row['tresc'];
    }

    $all = '<h3>'.$tytul.'</h3><div class="line"></div>'.$tresc;

    return $all;
}

function getImageArticle($id){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM artykul WHERE id='$id';");
    while($row = $result->fetch_assoc()) {
        return $row['obrazek'];
    }
}

function getArticleByContent($keyword){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM artykul WHERE tresc LIKE '%".$keyword."%' LIMIT 1;");
    while($row = $result->fetch_assoc()) {
        $tytul = $row['tytul'];
        $tresc = $row['tresc'];
    }

    $all = '<h3>'.$tytul.'</h3><div class="line"></div>'.$tresc;

    return $all;
}

?>