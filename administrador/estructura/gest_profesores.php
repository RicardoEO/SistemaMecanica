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
        <title>Gestionar ramos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style4.css">
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
    <body>
    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Editar</h2>
    </div>
    <div class="modal-body">
    <div class="inputs">
    <form class="modificar_gest" method="post" action="../gestionar/editar_profesores.php">
    <label>Rut</label>
    <input id="rut_gest" name="rut_gest" type="number">
    <label>Nombres</label>
    <input id="nombre_gest" name="nombre_gest" type="text">
    <label>Telefono</label>
    <input id="telefono_gest" name="telefono_gest" type="text">
    <label>Apellido Paterno</label>
    <input id="ap_paterno_gest" name="ap_paterno_gest" type="text">
    <label>Apellido Materno</label>
    <input id="ap_materno_gest" name="ap_materno_gest" type="text">
    <label>Correo electrónico</label>
    <input id="correo_gest" name="correo_gest" type="text">
    <input type="submit" value="Modificar">
    <input type="reset" value="Limpiar">
    </form>
    </div>
    </div>
    <!--The div element for the map -->

    </div>
    </div>

        <script type="text/javascript">

            $(document).ready(function(){
            $(".contenedor2").fadeIn(700);
            $(".modal").css("display", "none");
            });

           /*  function enviar() {
                var cod_ramo = document.getElementById('cod_ramo').value;
                var nom_ramo = document.getElementById('nom_ramo').value;
                var sem_ramo = document.getElementById('sem_ramo').value;

                var dataen = 'cod='+cod_ramo +'&nom='+nom_ramo + '&sem='+sem_ramo;

                $.ajax({
                    type: 'post',
                    url: '../registros/reg_ramos.php',
                    data: dataen,
                    success:function(resp) {
                        $("#respa").html(resp);
                    }
                });
            return false;
            } */

            function eliminar(_this) {
                var dataen = 'rut='+_this.id;
                var statusConfirm = confirm("¿Desea eliminar al alumno " + _this.name + "?");
                if (statusConfirm == true) {
                    $.ajax({
                        type: 'post',
                        url: '../registros/eliminar_alumno.php',
                        data: dataen,
                        success:function(resp) {
                            $(".tabla").load(" .tabla");
                            alert("Alumno eliminado exitosamente");
                        }
                    });
                } else {
                    end;
                }
            }

             // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal 
            function editar(_this) {
                var dataen = 'rut='+ _this.id;
                    $.ajax({
                        type: 'post',
                        url: '../gestionar/profesores.php',
                        data: dataen,
                        success:function(resp) {
                            resultado = JSON.parse(resp);
                            $('#rut_gest').val(resultado[0]);
                            $('#nombre_gest').val(resultado[1]);
                            $('#telefono_gest').val(resultado[2]);
                            $('#ap_paterno_gest').val(resultado[3]);
                            $('#ap_materno_gest').val(resultado[4]);
                            $('#correo_gest').val(resultado[5]);
                            modal.style.display = "block";
                        }
                    });
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
                
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
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
                <div onclick="location.href='./alumnos.php'" class="item"><img src="../../img/estudiante.png"><a href="./Alumnos.php">Alumnos</a></div>
                <div onclick="location.href='./profesores.php'" class="item"><img src="../../img/profesor.png"><a href="./profesores.php">Profesores</a></div>
                <div class="item" onclick="location.href='./autos.php'"><img src="../../img/coche.png"><a href="./Autos.php">Modelos</a></div>
                <div class="item" onclick="location.href='./cursos.php'"><img src="../../img/presentacion.png"><a href="./Cursos.php">Cursos</a></div>
            </div>
            <div class="asociar">
                <h3>Asociar</h3>
                <div class="item" onclick="location.href='./alumnos_cursos.php'"><img src="../../img/estudiante.png"><a href="./alumnos_cursos.php">Alumnos a cursos</a></div>
                <div class="item" onclick="location.href='./profesores_cursos.php'"><img src="../../img/profesor.png"><a href="./profesores_cursos.php">Profesores a cursos</a></div>
            </div>
            <div class="gestionar">
                <h3>Gestionar</h3>
                <div class="item" onclick="location.href='./gest_ramos.php'"><img src="../../img/books.png"><a href="./gest_ramos.php">Ramos</a></div>
                <div class="item" onclick="location.href='./gest_alumnos.php'"><img src="../../img/estudiante.png"><a href="./gest_alumnos.php">Alumnos</a></div>
                <div class="item" id="actual" onclick="location.href='./gest_profesores.php'" id="last_item"><img src="../../img/profesor.png"><a href="./gest_profesores.php">Profesores</a></div>
            </div>
           
            </nav> 
            <main class="contenedor2" style="display: none;">
             <section class="registro">   

                    <header class="titulo_reg"><h2>Gestionar profesores</h2></header>
                    <form method="post" class="formulario">
               
                        <table class="tabla">
                            <thead>
                                <tr>
                                    <th>Rut</th>
                                    <th>Nombres</th>
                                    <th>Telefono</th>
                                    <th>Ap.Paterno</th>
                                    <th>Ap.Materno</th>
                                    <th>Correo del profesor</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                require('../../conexion.php');
                                $consulta2 = "SELECT * from profesor";
    
                                $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");
    
                                while($fila=mysqli_fetch_array($resultset)) {
                                    echo "<tr>";
                                    echo "<td>" .$fila[0]. "</td>";
                                    echo "<td>" .$fila[1]. "</td>";
                                    echo "<td>" .$fila[2]. "</td>";
                                    echo "<td>" .$fila[3]. "</td>";
                                    echo "<td>" .$fila[4]. "</td>";
                                    echo "<td>" .$fila[5]. "</td>";
                                    echo "<td><img class='eliminar' name= '" .$fila[1]. "' src='../../img/delete.png' id='" .$fila[0]. "' onClick='eliminar(this);' alt='Eliminar'/>
                                    <img class='editar' name= '" .$fila[1]. "' src='../../img/edit.png' id='" .$fila[0]. "' onClick='editar(this);' alt='Editar'/></td>"; 
                                    echo "</tr>";
                                }
                                
                                ?>
                            </tbody>
                            </table>
                            
                        <div id="respa"></div>
                    </form>
           </section>
                 

          
            </main>
            <!--<footer>
            </footer>-->
        </div>

    </body>
</html>
