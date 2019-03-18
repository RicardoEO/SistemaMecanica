<?php

require ('../../conexion.php');

$nom_profesor = $_POST['nom_profesor'];
$ap_p_profesor = $_POST['ap_p_profesor'];
$ap_m_profesor = $_POST['ap_m_profesor'];
$rut = $_POST['rut'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$verificacion = "SELECT * from profesor where rutprofesor = '$rut'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

if ($contar == 0) {


	$consulta = "INSERT into profesor (rutprofesor, nombresprofesor, telefonoprofesor, appaterno, apmaterno, correoprofesor) values ('$rut', '$nom_profesor', '$telefono', '$ap_p_profesor', '$ap_m_profesor', '$correo')";

	$resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");

	$tabla_profesor = "SELECT id_usuario from usuario order by id_usuario desc limit 1";

	$resultset2 = mysqli_query($link, $tabla_usuario);

	$valor = mysqli_fetch_array($resultset2);

	$aumento = $valor[0];

	$aumento++;

	$consulta2 = "INSERT into usuario (id_usuario, rut_usuario, correo_usuario, password_usuario, privilegio) values ($aumento, '$rut', '$correo', '$rut', 2)";

	 $resultset3 = mysqli_query($link, $consulta2) or die ("Error en la consulta");  

	 
	if ($resultset && $resultset2) {
		echo "Profesor añadido correctamente";
	} else {
		echo "Ocurrio un problema en la operacion";
	}
} else {
	echo "Este Profesor ya esta registrado en el sistema";
}
?>