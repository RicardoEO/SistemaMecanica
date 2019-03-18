<?php

require ('../../conexion.php');

$nom_alumno = $_POST['nom_alumno'];
$ap_p_alumno = $_POST['ap_p_alumno'];
$ap_m_alumno = $_POST['ap_m_alumno'];
$rut = $_POST['rut'];
/* $telefono = $_POST['telefono']; */
$correo = $_POST['correo'];

$verificacion = "SELECT * from alumno where rutalumno = '$rut'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

if ($contar == 0) {


	$consulta = "INSERT into alumno (rutalumno, nombres, correoalumno, appaterno, apmaterno) values ('$rut', '$nom_alumno', '$correo', '$ap_p_alumno', '$ap_m_alumno')";

	$resultset = mysqli_query($link, $consulta);
 
	$tabla_usuario = "SELECT id_usuario from usuario order by id_usuario desc limit 1";

	$resultset2 = mysqli_query($link, $tabla_usuario);

	$valor = mysqli_fetch_array($resultset2);

	$aumento = $valor[0];

	$aumento++;

	$consulta2 = "INSERT into usuario (id_usuario, rut_usuario, correo_usuario, password_usuario, privilegio) values ($aumento, '$rut', '$correo', '$rut', 3)";

	 $resultset3 = mysqli_query($link, $consulta2) or die ("Error en la consulta");  
 

	if ($resultset && $resultset2) {
		echo "Alumno registrado con exito";
	} else {
		echo "Ocurrio un problema en la operacion";
	}
} else {
	echo "Este alumno ya esta registrado en el sistema";
}
?>