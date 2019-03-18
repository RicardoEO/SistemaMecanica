<?php

require ('../../conexion.php');

$cod_ramo = $_POST['cod'];
$nom_ramo = $_POST['nom'];
$sem_ramo = $_POST['sem'];

$verificacion = "SELECT * from ramo where idramo = '$cod_ramo'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

if ($contar == 0) {

$consulta = "INSERT into ramo (idramo, nombreramo, semestreramo) values ('$cod_ramo', '$nom_ramo', '$sem_ramo')";

$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	if ($resultset) {
		echo "Exito";
	} else {
		echo "Error";
	}

} else {
	echo "Esta Id ya existe";
}

?>