<?php

$rut = $_POST['rut'];

require('../../conexion.php');
$consulta2 = "SELECT * from alumno where rutalumno = $rut";

$resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");

while($fila=mysqli_fetch_array($resultset)) {
    $campos = [$fila[0], $fila[1], $fila[2], $fila[3], $fila[4]];  
    echo json_encode($campos);
}
?>