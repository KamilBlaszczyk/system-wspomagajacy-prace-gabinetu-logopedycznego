<?php

if(isset($_GET['page'])){
	$page = $_GET['page'];
	require "html/$page.php";
}
else{
    require "html/index.php";
}

?>