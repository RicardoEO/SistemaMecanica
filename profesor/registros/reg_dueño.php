<?php

require ('../../conexion.php');

$rut_dueño = $_POST['rut_dueño'];
$nombres_dueño = $_POST['nombres_dueño'];
$ap_p_dueño = $_POST['ap_p_dueño'];
$ap_m_dueño = $_POST['ap_m_dueño'];
$telefono_dueño = $_POST['telefono_dueño']; 


$verificacion = "SELECT * from dueno where rut_dueno = '$rut_dueño'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

if ($contar == 0) {


	$consulta = "INSERT into dueno (rut_dueno, nombres_dueno, appaternodueno, apmaternodueno, telefono_dueno) values ('$rut_dueño', '$nombres_dueño', '$ap_p_dueño', '$ap_m_dueño', '$telefono_dueño')";

	$resultset = mysqli_query($link, $consulta);

	if ($resultset) {
		echo "Alumno registrado con exito";
	} else {
		echo "Ocurrio un problema en la operacion";
	}
} else {
	echo "Este alumno ya esta registrado en el sistema";
}
?>