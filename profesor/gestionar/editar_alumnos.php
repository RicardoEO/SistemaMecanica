<?php
$rut = $_POST['rut_gest'];
$nombres = $_POST['nombres_gest'];
$correo = $_POST['correo_gest'];
$apellido_paterno = $_POST['ap_paterno_gest'];
$apellido_materno = $_POST['ap_materno_gest'];

require('../../conexion.php');

$consulta2 = "UPDATE alumno SET nombres='$nombres', correoalumno='$correo', appaterno='$apellido_paterno', apmaterno='$apellido_materno' where rutalumno=$rut;";

if (mysqli_query($link, $consulta2)) {
    header('Location: ../estructura/alumnos.php');
} else {
    echo "Error updating record: " . mysqli_error($link);
}

?>