<?php
$rut = $_POST['rut_gest'];
$nombres = $_POST['nombre_gest'];
$correo = $_POST['correo_gest'];
$apellido_paterno = $_POST['ap_paterno_gest'];
$apellido_materno = $_POST['ap_materno_gest'];
$telefono = $_POST['telefono_gest'];

require('../../conexion.php');

$consulta2 = "UPDATE profesor SET nombresprofesor='$nombres', correoprofesor='$correo', appaterno='$apellido_paterno', apmaterno='$apellido_materno', , telefonoprofesor='$telefono' where rutprofesor=$rut;";

if (mysqli_query($link, $consulta2)) {
    header('Location: ../estructura/gest_profesores.php');
} else {
    echo "Error updating record: " . mysqli_error($link);
}

?>