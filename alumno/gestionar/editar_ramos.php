<?php
$id = $_POST['id_gest'];
$nombre = $_POST['nombre_gest'];
$semestre = $_POST['semestre_gest'];

require('../../conexion.php');

$consulta2 = "UPDATE ramo SET nombreramo='$nombre', semestreramo=$semestre where idramo=$id;";

if (mysqli_query($link, $consulta2)) {
    header('Location: ../estructura/gest_ramos.php');
} else {
    echo "Error updating record: " . mysqli_error($link);
}

?>