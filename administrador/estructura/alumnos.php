<?php
session_start();
if (isset($_SESSION['privilegio'], $_SESSION['email'])) {
    if ($_SESSION['privilegio'] != 1) {
        header('Location: ../../login/login.php');
    } else {

    }
} else {
    header('Location: ../../login/login.php');
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <title>Registro de Alumnos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    </head>
    <style>
        #actual {
            background-color: #262626;
        }
    </style>
    <script type="text/javascript">

            $(document).ready(function(){
            $(".contenedor2").fadeIn(700);
            });

            function enviar() {
                var rut = document.getElementById('rut').value;
                var ap_p_alumno = document.getElementById('ap_p_alumno').value;
                var ap_m_alumno = document.getElementById('ap_m_alumno').value;
                var nom_alumno = document.getElementById('nom_alumno').value;
                var correo = document.getElementById('correo').value;
                var telefono = document.getElementById('telefono').value;
                alert(telefono);

                var dataen = 'rut='+rut +'&ap_p_alumno='+ap_p_alumno + '&ap_m_alumno='+ap_m_alumno + '&nom_alumno=' + nom_alumno + '&correo=' + correo + '&telefono=' + telefono;

                $.ajax({
                    type: 'post',
                    url: '../registros/reg_alumnos.php',
                    data: dataen,
                    success:function(resp) {
                        $("#respa").html(resp);
                    }
                });
            
            return false;
            }
            function cerrarSesion() {
                $.ajax({
                    type: 'post',
                    url: '../../login/cerrar_sesion.php',
                    success:function(resp) {
                        location.href ="../../login/login.php";
                    }
                });
            }
        </script>
    <body>
    <div id='cssmenu'>
            <ul>
            <li style="margin-left: 320px" class=''><a href='index.php'><span>Universidad</span></a></li>
            <li><a href='index.php'><span>Nosotros</span></a></li>
            <li class='last'><a href='#'><span>Contacto</span></a></li>
            <li onclick="cerrarSesion();" style="float:right" class='last'><a href='#'><span>Cerrar sesión</span></a></li>
            </ul>
            </div>
         <div class="contenedor">
         <nav class="menu">
            <div class="agregar">
                <h3>Agregar</h3>
                <div onclick="location.href='./index.php'" class="item"><img src="../../img/books.png"><a href="./index.php">Ramos</a></div>
                <div onclick="location.href='./alumnos.php'" id="actual" class="item"><img src="../../img/estudiante.png"><a href="">Alumnos</a></div>
                <div onclick="location.href='./profesores.php'" class="item"><img src="../../img/profesor.png"><a href="./profesores.php">Profesores</a></div>
                <div class="item" onclick="location.href='./autos.php'"><img src="../../img/coche.png"><a href="./Autos.php">Modelos</a></div>
                <div class="item" onclick="location.href='./cursos.php'"><img src="../../img/presentacion.png"><a href="./Cursos.php">Cursos</a></div>
            </div>
            <div class="asociar">
                <h3>Asociar</h3>
                <div class="item" onclick="location.href='./alumnos_cursos.php"><img src="../../img/estudiante.png"><a href="./alumnos_cursos.php">Alumnos a cursos</a></div>
                <div class="item" onclick="location.href='./profesores_cursos.php"><img src="../../img/profesor.png"><a href="./profesores_cursos.php">Profesores a cursos</a></div>
            </div>
            <div class="gestionar">
                <h3>Gestionar</h3>
                <div class="item" onclick="location.href='./gest_ramos.php'"><img src="../../img/books.png"><a href="./gest_ramos.php">Ramos</a></div>
                <div class="item" onclick="location.href='./gest_alumnos.php'"><img src="../../img/estudiante.png"><a href="./gest_alumnos.php">Alumnos</a></div>
                <div class="item" onclick="location.href='./gest_profesores.php'" id="last_item"><img src="../../img/profesor.png"><a href="./gest_profesores.php">Profesores</a></div>
            </div>
           
            </nav> 
            <main class="contenedor2" style="display: none;">
             <section class="registro">   

                    <header class="titulo_reg"><h2>Añadir Alumnos</h2></header>
                    <form onsubmit="return enviar();" method="post" class="formulario">
                        <label>Nombres</label><input id="nom_alumno" type="text" required>
                         <label>Apellido Paterno</label><input id="ap_p_alumno" type="text" required>
                         <label>Apellido Materno</label><input id="ap_m_alumno" type="text" required>
                         <label>RUT</label><input id="rut" type="text" required>
                         <label>Telefono</label> <input id="telefono" type="number" required>
                         <label>Correo</label><input id="correo" type="email" required>
                         <!-- <label>Curso</label> -->
                         <!-- <select>
                            <option value="">Seleccione</option>
                         <?php /*
                         require('conexion.php');
                         $consulta2 = "SELECT idcurso, nombrecurso from curso";

                        $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");

                        while($fila=mysqli_fetch_array($resultset)) {
                            echo "<option name='curso' value='".$fila[idcurso]."'>".$fila[nombrecurso]."</option>";
                        }*/
                         ?>
                     </select> -->
                        <div class="botones">
                            <input type="submit" value="Grabar" class="grabar">
                            <input type="reset" value="Limpiar" class="limpiar">
                        </div>
                        <div id="respa"></div>
                    </form>
           </section>
                 

          
            </main>
            <!--<footer>
            </footer>-->
        </div>
    </body>
</html>
