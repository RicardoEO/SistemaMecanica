<?php

require ('../../conexion.php');
$campos = array();
$id = $_POST['id'];

$verificacion = "SELECT id_modelo, nombremodelo from modelo where id_marca = $id";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

$verificacion2 = "SELECT id_modelo, nombremodelo from modelo where id_marca = $id";

$pre_rs2 = mysqli_query($link, $verificacion2);

while($fila=mysqli_fetch_array($pre_rs2)) {
    array_push($campos,[$fila[0]]); 
    array_push($campos,[$fila[1]]); 
}
array_push($campos, $contar);
echo json_encode($campos);

?>