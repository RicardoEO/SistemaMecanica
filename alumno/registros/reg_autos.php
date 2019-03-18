<?php

require ('../../conexion.php');

$id = $_POST['id'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];

$verificacion = "SELECT * from modelo where id_modelo = '$id'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

if ($contar == 0) {


	$consulta = "INSERT into modelo (id_modelo, id_marca, nombremodelo) values ('$id', '$marca', '$modelo')";

	$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	if ($resultset) {
		echo "Modelo añadido correctamente";
	} else {
		echo "Ocurrio un problema en la operacion";
	}
} else {
	echo "Este Modelo ya esta registrado en el sistema";
}
?>