<?php

if(!isset($_GET['page'])){
	header("Location: index.php?page=login");
}

if(isset($_GET['page'])){
	$page = $_GET['page'];
	require "modules/$page.php";
}


?>
	
