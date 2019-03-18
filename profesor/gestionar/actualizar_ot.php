<?php
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$id_automovil = $_POST['id_automovil'];
$rut_profesor = $_POST['rut_profesor'];
$fecha_creacion = $_POST['fecha_creacion'];

require('../../conexion.php');

$consulta2 = "UPDATE ordendetrabajo SET id_ot='$id', nombre_ot='$nombre', idautomovil='$id_automovil', rutprofesor1='$rut_profesor', fecha_creacion='$fecha_creacion' where id_ot=$id;";

if (mysqli_query($link, $consulta2)) {
    echo "Registros actualizados correctamente";
} else {
    echo "Error updating record: " . mysqli_error($link);
}

?>