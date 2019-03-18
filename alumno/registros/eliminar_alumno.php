<?php

require ('../../conexion.php');

$rut = $_POST['rut'];

$consulta = "DELETE from alumno where rutalumno = '$rut'";

	$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	if ($resultset) {
		echo "Alumno eliminado correctamente" . $rut;
	} else {
		echo "Ocurrio un problema en la operacion";
	}
?>