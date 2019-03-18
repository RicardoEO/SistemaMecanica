<?php

$id = $_POST['cod'];

require('../../conexion.php');
$consulta2 = "SELECT * from ramo where idramo = $id";

$resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");

while($fila=mysqli_fetch_array($resultset)) {
    $campos = [$fila[0], $fila[1], $fila[2]];  
    echo json_encode($campos);
}
?>