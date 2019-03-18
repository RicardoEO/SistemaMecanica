<?php

require ('../../conexion.php');

$cursos = json_decode($_POST['cursos']);
$rutalumno = $_POST['rutalumno'];
/* $telefono = $_POST['telefono']; */
$fecha = $_POST['fecha'];
 for ($i=0;$i<count($cursos);$i++)    
{     
    $verificacion = "SELECT * from alumno_curso where rutalumno = '$rutalumno' and idcurso = '$cursos[$i]';";

    $pre_rs = mysqli_query($link, $verificacion);

    $contar = mysqli_num_rows($pre_rs);
$tamaño = count($cursos);
    if ($contar == 0) {


        $consulta = "INSERT into alumno_curso (rutalumno, idcurso, fecha) values ('$rutalumno', '$cursos[$i]', '$fecha')";
    
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