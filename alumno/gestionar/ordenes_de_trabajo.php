<?php

$id = $_POST['id'];

require('../../conexion.php');
$consulta2 = "SELECT * from ordendetrabajo where id_ot = $id";

$resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta ordenes_de_trabajo");

while($fila=mysqli_fetch_array($resultset)) {
    $campos = [$fila['ID_OT'], $fila['NOMBRE_OT'], $fila['IDAUTOMOVIL'], $fila['rutProfesor1'], $fila['FECHA_CREACION'], $fila['ESTADO']];  
    echo json_encode($campos);
}
?>