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
        <link rel="stylesheet" href="../../css/style2.css">
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
    <body>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".contenedor2").fadeIn(700);
            });

            function enviar() {
                var cursos = $("#cursos").val();
                var rutalumno = document.getElementById('rutalumno').value;
                var fecha = document.getElementById('fecha').value;

                var dataen = 'rutalumno='+rutalumno +'&cursos='+JSON.stringify(cursos)+'&fecha='+fecha;

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

            $(function(){
                $("#form_archivo").on("submit", function(e){
                    e.preventDefault();
                    var f = $(this);
                    var formData = new FormData(document.getElementById("form_archivo"));
                    var fecha = document.getElementById('fecha').value;
                    formData.append("fecha", fecha);
                    var cursos = document.getElementById('cursos_excel').value;
                    formData.append("cursos_excel", cursos);

       

                    $.ajax({
                        url: "../registros/archivo.php",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                        .done(function(res){
                            $("#respa2").html("Respuesta: " + res);
                        });
                });
            });
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
                <div onclick="location.href='./index.php'" class="item"><img src="../../img/books.png"><a href="./index.php">Ramos</a></div>
                <div onclick="location.href='./alumnos.php'" class="item"><img src="../../img/estudiante.png"><a href="./Alumnos.php">Alumnos</a></div>
                <div onclick="location.href='./profesores.php'" class="item"><img src="../../img/profesor.png"><a href="./profesores.php">Profesores</a></div>
                <div class="item" onclick="location.href='./autos.php'"><img src="../../img/coche.png"><a href="./Autos.php">Modelos</a></div>
                <div class="item" onclick="location.href='./cursos.php'"><img src="../../img/presentacion.png"><a href="./Cursos.php">Cursos</a></div>
            </div>
            <div class="asociar">
                <h3>Asociar</h3>
                <div class="item" id="actual" onclick="location.href='./alumnos_cursos.php'"><img src="../../img/estudiante.png"><a href="./alumnos_cursos.php">Alumnos a cursos</a></div>
                <div class="item" onclick="location.href='./profesores_cursos.php'"><img src="../../img/profesor.png"><a href="./profesores_cursos.php">Profesores a cursos</a></div>
            </div>
            <div class="gestionar">
                <h3>Gestionar</h3>
                <div class="item" onclick="location.href='./gest_ramos.php'"><img src="../../img/books.png"><a href="./gest_ramos.php">Ramos</a></div>
                <div class="item" onclick="location.href='./gest_alumnos.php'"><img src="../../img/estudiante.png"><a href="./gest_alumnos.php">Alumnos</a></div>
                <div class="item" onclick="location.href='./gest_profesores.php'" id="last_item"><img src="../../img/profesor.png"><a href="./gest_profesores.php">Profesores</a></div>
            </div>
            <div class="logout" onclick="cerrarSesion();"><img src="../../img/smartphone.png" title="Cerrar sesión"></div>
            </nav> 
            <main class="contenedor2" style="display: none;">
             <section class="registro">   

                    <header class="titulo_reg"><h2>Asociar alumno a cursos</h2></header>
                    <form onsubmit="return enviar();" method="post" class="formulario">
                        <label>Alumno</label>
                        <select id="rutalumno">
                            <?php 
                            require('../../conexion.php');
                            $consulta2 = "SELECT rutalumno, nombres, appaterno, apmaterno from alumno";

                            $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");

                            while($fila=mysqli_fetch_array($resultset)) {
                                echo "<option value='".$fila[rutalumno]."'>".$fila[nombres]." ".$fila[appaterno]." ".$fila[apmaterno]."</option>";
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
           <section class="excel">      
                <header class="titulo_reg"><h2>Importar mediante Excel</h2></header>
                <form method="post" id="form_archivo" name="archivos" enctype='multipart/form-data'>
                <label class="titulo_excel">Curso/s (Para seleccionar mas de un curso presione las teclas: Ctrl + Click)</label>
                            <?php
                            require('../../conexion.php');
                            $consulta3 = "SELECT idcurso, nombrecurso from curso";

                            $resultset2 = mysqli_query($link, $consulta3) or die ("Error en la consulta");
                            $cantidad2 = mysqli_num_rows($resultset2);
                            echo "<select id='cursos_excel' name='cursos'>";
                            while($fila=mysqli_fetch_array($resultset2)) {
                                echo "<option value='".$fila[idcurso]."'>".$fila[nombrecurso]."</option>";
                            }
                            ?>
                        </select>
                <div class="cont_archivo">
                <input id="fecha" type="date">
                    <label class="label_archivo">Archivo</label>
                    <input id="fecha" type="file" name="archivo" class="archivo">
                    <div class="botones">
                        <input class="btn_archivo" type="submit" value="Subir">
                    </div>
                    <div id="respa2"></div>
                        </div>
                </form>
            </section>
            

          
            </main>
            <!--<footer>
            </footer>-->
        </div>
    </body>
</html>
