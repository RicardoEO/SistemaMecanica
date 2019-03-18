<?php

require ('../../conexion.php');

$id = $_POST['id'];

$consulta = "DELETE from ordendetrabajo where id_ot = '$id'";

	$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	if ($resultset) {
		echo "Orden de trabajo eliminada correctamente" . $rut;
	} else {
		echo "Ocurrio un problema en la operacion";
	}
?>