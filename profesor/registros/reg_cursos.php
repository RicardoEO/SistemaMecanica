<?php

require ('../../conexion.php');

$id = $_POST['id'];
$nombre_curso = $_POST['nombre_curso'];
$ramo = $_POST['ramo'];
$seccion = $_POST['seccion'];
$año = $_POST['año'];
$semestre = $_POST['semestre'];

$verificacion = "SELECT * from curso  where idcurso = '$id'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

if ($contar == 0) {


	$consulta = "INSERT into curso (idcurso, nombrecurso, seccion, ano, semestrecurso, idramo) values ('$id', '$nombre_curso', '$seccion', '$año', '$semestre', '$ramo')";

	$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	if ($resultset) {
		echo "Curso añadido correctamente";
	} else {
		echo "Ocurrio un problema en la operacion";
	}
} else {
	echo "Este Curso ya esta registrado en el sistema";
}
?>