<?php

require ('../../conexion.php');

$cursos = json_decode($_POST['cursos']);
$rutprofesor = $_POST['rutprofesor'];
/* $telefono = $_POST['telefono']; */
$fecha = $_POST['fecha'];
 for ($i=0;$i<count($cursos);$i++)    
{     
    $verificacion = "SELECT * from profesor_curso where rutprofesor = '$rutprofesor' and idcurso = '$cursos[$i]';";

    $pre_rs = mysqli_query($link, $verificacion);

    $contar = mysqli_num_rows($pre_rs);
$tamaño = count($cursos);
    if ($contar == 0) {


        $consulta = "INSERT into profesor_curso (rutprofesor, idcurso, fecha) values ('$rutprofesor', '$cursos[$i]', '$fecha')";
    
        $resultset = mysqli_query($link, $consulta) or die ("Error en la consulta");
    
        if ($resultset) {
            $consulta3 = "SELECT nombrecurso from curso where idcurso = '$cursos[$i]'";
            $resultset3 = mysqli_query($link, $consulta3) or die ("Error en la consulta");
            while($fila=mysqli_fetch_array($resultset3)) {
                echo "El curso  ' $fila[0] ' fue añadido correctamente. <br>";
            }
        } else {
            echo "Ocurrio un problema en la operacion";
        }
    } else {
        $consulta2 = "SELECT nombrecurso from curso where idcurso = '$cursos[$i]'";
        $resultset2 = mysqli_query($link, $consulta2) or die ("Error en la consulta");
        while($fila=mysqli_fetch_array($resultset2)) {
            echo " Este alumno ya esta registrado en el curso ' $fila[0] ' <br>";
        }
        $contar = 0;
    }
}  


?>