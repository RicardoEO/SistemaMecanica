<?php

require ('../../conexion.php');

$id = $_POST['cod'];

$consulta = "DELETE from ramo where idramo = '$id'";

	$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	if ($resultset) {
		echo "Ramo eliminado correctamente" . $id;
	} else {
		echo "Ocurrio un problema en la operacion";
	}
?>