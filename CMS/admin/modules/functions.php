<?php

// Alert logowania do panelu
/**
 * Kody błędów ($num)
 * 1 - Zalogowano
 * 2 - Błędne dane logowania
 * 3 - informacja
 */
function alertLoginBox($num, $str){
    echo '<div class="col-lg-4 col-md-4 col-md-offset-4 col-lg-offset-4 admin-nopadding__login">';

    switch($num){
        case 1:
            echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span>'.$str.'</div>';
            break;
        case 2:
            echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove"></span>'.$str.'</div>';
            break;
        case 3:
            echo '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-check"></span>'.$str.'</div>';
            break;
        default:
            echo '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-ban-circle"></span>'.$str.'</div>';
            break;
    }
                    
    echo '</div>';
}

/**
 * Alert informacyjny na stronę
 * 
 * 1 - Usuwanie
 * 2 - Informacja
 * 3 - Error box
 * 
 */

function modalBox($num, $str){
    echo '<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    switch($num){
        case 1:
        
        echo '<h4 class="modal-title" id="myModalLabel">Usunięto</h4>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<p class="green"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;&nbsp;'.$str.'</p>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-success" data-dismiss="modal">Zamknij</button>';

        break;
        case 2:

        echo '<h4 class="modal-title" id="myModalLabel">Informacja</h4>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<p class="info"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span>&nbsp;&nbsp;'.$str.'</p>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-info" data-dismiss="modal">Zamknij</button>';
        break;

        case 3:

        echo '<h4 class="modal-title" id="myModalLabel">Wystąpił błąd!</h4>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<p class="red"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;&nbsp;'.$str.'</p>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>';
        break;

    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

/**
 * Funkcje potrzebne do operacji na zdjecicah
 */

function resize_image($file) {
    list($width, $height) = getimagesize($file);
    if($width>2000 || $height>2000){
        $newwidth = round($width * 1/4);
        $newheight = round($height * 1/4);
    }
    else{
        $newwidth = $width;
        $newheight = $height;
    }

    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

function orientation($exif){
    foreach ($exif as $key => $val) {
        if(strtolower($key) == "orientation"){
            return $val;
        }
    }
}

function orientationflag($ori){
    switch ($ori) {
      case 1:
        return 0;
        break;
      case 3:
        return 180;
        break;
      case 6:
        return 270;
        break;
      case 8:
        return 90;
        break;
    }
}

/**
 * 
 * Upload zdjęć na serwer oraz zmiana rozmiaru
 * 
 * $name = nazwa modułu do jakiego wgrywane są zdjęcia
 * $postFile = zdjęcie w formacie post
 * 
 * Zwracane kody blędów
 * 1 - pusty obrazek
 * 2 - niepoprawny format
 * 3 - nieznany błąd
 */

function upload_image($name, $postFile){
    switch($name){
        case "article":
            $target_dir = "../galleries/article/";
            $target_file = $target_dir . basename($postFile["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($postFile["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                return 1;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $uploadOk = 0;
                return 2;
            }

            if($uploadOk != 0){
                if (move_uploaded_file($postFile["tmp_name"], $target_file)) {
                    $date = date("YmdGis");
                    rename($target_dir.$postFile["name"], $target_dir.$date.".".$imageFileType);
            
                    $org = $target_dir.$date.".".$imageFileType;
                    $rot = $target_dir.$date.".".$imageFileType;
            
                    $exif = exif_read_data($org);
            
                    $img = resize_image($org);
                    unlink($org);
                    imagejpeg($img, $org);
            
                    $ori = orientation($exif);
                    $deg = orientationflag($ori);
            
                    $image_data = imagecreatefromjpeg($org);
                    $image_rotate = imagerotate($image_data, $deg, 0);
            
                    unlink($org);
                    imagejpeg($image_rotate, $rot);
                    imagedestroy($image_data);
                    imagedestroy($image_rotate);
                    imagedestroy($img);

                    return $date.".".$imageFileType;
            
                    //Miniaturka
                    //copy($target_dir.$date.".".$imageFileType, $target_dir."/thumb/".$date."_thumb.".$imageFileType);
                } else {
                    return 3;
                }
            }

        break;
        case "gallery":
            $target_dir = "../galleries/gallery/";
            $target_file = $target_dir . basename($postFile["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($postFile["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                return 1;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $uploadOk = 0;
                return 2;
            }

            if($uploadOk != 0){
                if (move_uploaded_file($postFile["tmp_name"], $target_file)) {
                    $date = date("YmdGis");
                    rename($target_dir.$postFile["name"], $target_dir.$date.".".$imageFileType);
            
                    $org = $target_dir.$date.".".$imageFileType;
                    $rot = $target_dir.$date.".".$imageFileType;
            
                    $exif = exif_read_data($org);
            
                    $img = resize_image($org);
                    unlink($org);
                    imagejpeg($img, $org);
            
                    $ori = orientation($exif);
                    $deg = orientationflag($ori);
            
                    $image_data = imagecreatefromjpeg($org);
                    $image_rotate = imagerotate($image_data, $deg, 0);
            
                    unlink($org);
                    imagejpeg($image_rotate, $rot);
                    imagedestroy($image_data);
                    imagedestroy($image_rotate);
                    imagedestroy($img);

                    return $date.".".$imageFileType;
            
                    //Miniaturka
                    //copy($target_dir.$date.".".$imageFileType, $target_dir."/thumb/".$date."_thumb.".$imageFileType);
                } else {
                    return 3;
                }
            }
        break;
    }
}

/**
 * Usuwanie katalogów
 * 
 * $dir = katalog do usunięcia wraz z plikami
 */
function delTree($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
} 

/**
* Usuwanie plików
* $file = ścieżka do pliku
*/
function delFile($file){
    unlink($file);
}