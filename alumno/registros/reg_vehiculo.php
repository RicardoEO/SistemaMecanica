<?php
session_start();
require ('../../conexion.php');
$alumnos = json_decode($_POST['alumnos']);
$fecha_grupo = $_POST['fecha_grupo'];
$nombre_auto = $_POST['nombre_auto'];
$patente_auto = $_POST['patente_auto'];
$marca_auto = $_POST['marca_auto'];
$modelo_auto = $_POST['modelo_auto']; 
$año_auto = $_POST['año_auto'];
$km_auto = $_POST['km_auto']; 
$chasis = $_POST['chasis']; 
$nombre_imagen = $_FILES['imagen']['name'];
$tipo_imagen = $_FILES['imagen']['type'];
$tamano_imagen = $_FILES['imagen']['size'];
$vin = $_POST['vin']; 
$sintomas = $_POST['sintomas'];

$timestamp = strtotime($fecha_grupo);
$fecha = date("Y-m-d H:i:s", $timestamp);

$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/paginaweb/profesor/registros/archivos/';

move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);

$archivo_objetivo = fopen($carpeta_destino . $nombre_imagen, "r");

$contenido = fread($archivo_objetivo, $tamano_imagen);

$contenido = addslashes($contenido);

fclose($archivo_objetivo);

/* $verificacion = "SELECT * from automovil where idautomovil = '$patente_auto'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs); */


	$verificacion2 = "SELECT id_grupo from alumno_grupodetrabajo order by id_grupo desc limit 1;";

	$pre_rs2 = mysqli_query($link, $verificacion2);

	$aumento = mysqli_fetch_array($pre_rs2);

	$numero = $aumento[0] + 1;

	$consulta = "INSERT into grupodetrabajo (id_grupo, nombre_grupo) values ($numero, 'prueba')";

	$resultset = mysqli_query($link, $consulta);

	for ($i=0;$i<count($alumnos);$i++)    
	{     

	$consulta2 = "INSERT into alumno_grupodetrabajo (id_grupo, rutalumno, fecha) values ($numero, '$alumnos[$i]', '$fecha')";

	$resultset2 = mysqli_query($link, $consulta2);
	}

	$verificacion3 = "SELECT idautomovil from automovil order by idautomovil desc limit 1;";

	$pre_rs3 = mysqli_query($link, $verificacion3);

	$aumento2 = mysqli_fetch_array($pre_rs3);

	$numero2 = $aumento2[0] + 1;

	$consulta3 = "INSERT into automovil (idautomovil, rut_dueno, id_modelo, patente, ano, foto, numerochasis, kilometraje, vin, sintoma_anomalia) values ($numero2, '$nombre_auto', $modelo_auto, '$patente_auto', $año_auto, 
	'$contenido', '$chasis', $km_auto, $vin, '$sintomas')";

	$resultset3 = mysqli_query($link, $consulta3) or die ("Error en la consulta");

	$verificacion4 = "SELECT id_ot from ordendetrabajo order by id_ot desc limit 1;";

	$pre_rs4 = mysqli_query($link, $verificacion4);

	$aumento3 = mysqli_fetch_array($pre_rs4);

	$numero3 = $aumento3[0] + 1;

	$rut = $_SESSION['rut'];

	$consulta4 = "INSERT into ordendetrabajo (id_ot, idautomovil, rutProfesor1, gru_id_grupo, nombre_ot, estado, fecha_creacion) values ($numero3, $numero2, 
	$rut, $numero, $numero3, 'Recepcionado', '$fecha')";

	echo $consulta2;

	$resultset4 = mysqli_query($link, $consulta4) or die ("Error en la consulta");
 
 

?>