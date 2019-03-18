<?php

require ('../conexion.php');

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

$verificacion = "SELECT * from usuario where correo_usuario = '$email' and password_usuario = '$contrasena'";

$pre_rs = mysqli_query($link, $verificacion);

$contar = mysqli_num_rows($pre_rs);

$datos = mysqli_fetch_array($pre_rs);

if ($contar == 1) {
    session_start();
    $_SESSION['privilegio'] = $datos['PRIVILEGIO'];
    $_SESSION['email'] = $datos['CORREO_USUARIO'];
    $_SESSION['rut'] = $datos['RUT_USUARIO'];
    
    echo $_SESSION['privilegio']; 
  

} else {
    echo $_SESSION['privilegio']; 

} 
?>