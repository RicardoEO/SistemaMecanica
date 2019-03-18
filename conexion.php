<?php

$host = "localhost";
$username = "root";
$password = "";
$port = 3306;
$database = "mecanica";

	$link = mysqli_connect($host, $username, $password, $database, $port) or die ("Error");
	mysqli_set_charset($link,"utf8");
?>