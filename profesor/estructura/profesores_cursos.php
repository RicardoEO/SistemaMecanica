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
        <title>Registro de Ramos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <meta charset="utf-8">
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
    var cursos = $("#cursos").val();
    var rutprofesor = document.getElementById('rutprofesor').value;
    var fecha = document.getElementById('fecha').value;

    var dataen = 'rutprofesor='+rutprofesor +'&cursos='+JSON.stringify(cursos)+'&fecha='+fecha;

     $.ajax({
        type: 'post',
        url: '../registros/reg_alumnos_cursos.php',
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
         <nav class="sidebar">
            <header class="logo">
                    <img src="../../img/logo.png" height="50" width="60">
            </header>
                    <a href="">Sobre Nosotros</a>
                    <a href="">Universidad</a>
                    <a href="">Contacto</a>
            </nav>
         <div class="contenedor">
         <nav class="menu">
            <div class="agregar">
                <h3>Agregar</h3>
                <div onclick="location.href='./index.php'" class="item"><img src="../img/books.png"><a href="./index.php">Ramos</a></div>
                <div onclick="location.href='./alumnos.php'" class="item"><img src="../img/estudiante.png"><a href="./Alumnos.php">Alumnos</a></div>
                <div onclick="location.href='./profesores.php'" class="item"><img src="../img/profesor.png"><a href="./profesores.php">Profesores</a></div>
                <div class="item" onclick="location.href='./autos.php'"><img src="../img/coche.png"><a href="./Autos.php">Modelos</a></div>
                <div class="item" onclick="location.href='./cursos.php'"><img src="../img/presentacion.png"><a href="./Cursos.php">Cursos</a></div>
            </div>
            <div class="asociar">
                <h3>Asociar</h3>
                <div class="item" onclick="location.href='./alumnos_cursos.php'"><img src="../img/estudiante.png"><a href="./alumnos_cursos.php">Alumnos a cursos</a></div>
                <div class="item" id="actual" onclick="location.href='./profesores_cursos.php'"><img src="../img/profesor.png"><a href="./profesores_cursos.php">Profesores a cursos</a></div>
            </div>
            <div class="gestionar">
                <h3>Gestionar</h3>
                <div class="item" onclick="location.href='./gest_ramos.php'"><img src="../img/books.png"><a href="./gest_ramos.php">Ramos</a></div>
                <div class="item" onclick="location.href='./gest_alumnos.php'"><img src="../img/estudiante.png"><a href="./gest_alumnos.php">Alumnos</a></div>
                <div class="item" onclick="location.href='./gest_profesores.php'" id="last_item"><img src="../img/profesor.png"><a href="./gest_profesores.php">Profesores</a></div>
            </div>
            <div class="logout" onclick="cerrarSesion();"><img src="../img/smartphone.png" title="Cerrar sesión"></div>
            </nav> 
            <main class="contenedor2" style="display: none;">
             <section class="registro">   

                    <header class="titulo_reg"><h2>Asociar profesor a cursos</h2></header>
                    <form onsubmit="return enviar();" method="post" class="formulario">
                        <label>Profesor</label>
                        <select id="rutprofesor">
                            <?php 
                            require('../../conexion.php');
                            $consulta2 = "SELECT rutprofesor, nombresprofesor, appaterno, apmaterno from profesor";

                            $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");

                            while($fila=mysqli_fetch_array($resultset)) {
                                echo "<option value='".$fila[rutprofesor]."'>".$fila[nombresprofesor]." ".$fila[appaterno]." ".$fila[apmaterno]."</option>";
                            }
                            ?>
                        </select>
                         <label>Curso/s (Para seleccionar mas de un curso presione las teclas: Ctrl + Click)</label>
                            <?php
                            require('../../conexion.php');
                            $consulta2 = "SELECT idcurso, nombrecurso from curso";

                            $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");
                            $cantidad = mysqli_num_rows($resultset);
                            echo "<select id='cursos' name='cursos' multiple size='".$cantidad."'>";
                            while($fila=mysqli_fetch_array($resultset)) {
                                echo "<option value='".$fila[idcurso]."'>".$fila[nombrecurso]."</option>";
                            }
                            ?>
                        </select>
                        <label>Fecha</label>
                        <input id="fecha" type="date">
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
