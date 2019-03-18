<?php
session_start();
if (isset($_SESSION['privilegio'], $_SESSION['email'])) {
    if ($_SESSION['privilegio'] != 2) {
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
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../../css/style_profesor.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="../../js/jquery.dataTables.min.js"></script>
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
    <form class="modificar_gest" method="post" action="../gestionar/editar_alumnos.php">
    <label>Rut</label>
    <input id="rut_gest" name="rut_gest" type="number">
    <label>Nombres</label>
    <input id="nombres_gest" name="nombres_gest" type="text">
    <label>Correo</label>
    <input id="correo_gest" name="correo_gest" type="text">
    <label>Apellido Paterno</label>
    <input id="ap_paterno_gest" name="ap_paterno_gest" type="text">
    <label>Apellido Materno</label>
    <input id="ap_materno_gest" name="ap_materno_gest" type="text">
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
            $(".modal").css("display", "none");
            $(".registro").fadeIn(800);
            $(".registrar_alumno").click(function() 
            {
                $(".cuerpo").slideToggle("slow");
            });

               $(".registrar_alumno2").click(function() 
            {
                $(".cuerpo2").slideToggle("slow");
            });

            $(".registrar_alumno3").click(function() 
            {
                $(".cuerpo3").slideToggle("slow");
            });

            $(".registrar_alumno4").click(function() 
            {
                $(".cuerpo4").slideToggle("slow");
            });

            $(".registrar_alumno5").click(function() 
            {
                $(".cuerpo5").slideToggle("slow");
            });

            $('#tabla').DataTable();
            
        });

            function enviar2() {
                var rut = document.getElementById('rut').value;
                var ap_p_alumno = document.getElementById('ap_p_alumno').value;
                var ap_m_alumno = document.getElementById('ap_m_alumno').value;
                var nom_alumno = document.getElementById('nom_alumno').value;
                var correo = document.getElementById('correo').value;
                var telefono = document.getElementById('telefono').value;

                var dataen = 'rut='+rut +'&ap_p_alumno='+ap_p_alumno + '&ap_m_alumno='+ap_m_alumno + '&nom_alumno=' + nom_alumno + '&correo=' + correo + '&telefono' + telefono;

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

            $(function(){
                $("#form_archivo").on("submit", function(e){
                    e.preventDefault();
                    var f = $(this);
                    var formData = new FormData(document.getElementById("form_archivo"));
                    var fecha = document.getElementById('fecha').value;
                    formData.append("fecha", fecha);
                    /* var cursos = document.getElementById('cursos_excel').value;
                    formData.append("cursos_excel", cursos); */

       

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

            $(function(){
                $("#form_archivo2").on("submit", function(e){
                    e.preventDefault();
                    var f = $(this);
                    var formData = new FormData(document.getElementById("form_archivo2"));
                    var fecha = document.getElementById('fecha').value;
                    formData.append("fecha", fecha);
                    /* var cursos = document.getElementById('cursos_excel').value;
                    formData.append("cursos_excel", cursos); */

       

                    $.ajax({
                        url: "../registros/archivo_cursos.php",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                        .done(function(res){
                            $("#respa4").html("Respuesta: " + res);
                        });
                });
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
                        $("#respa3").html(resp);
                    }
                });
                
            return false; 
            }

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
                        url: '../gestionar/alumnos.php',
                        data: dataen,
                        success:function(resp) {
                            resultado = JSON.parse(resp);
                            $('#rut_gest').val(resultado[0]);
                            $('#nombres_gest').val(resultado[1]);
                            $('#correo_gest').val(resultado[2]);
                            $('#ap_paterno_gest').val(resultado[3]);
                            $('#ap_materno_gest').val(resultado[4]);
                            $('#myModal').css("display", "block");
                        }
                    });
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                $('#myModal').css("display", "none");
                
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    $('#myModal').css("display", "none");
                }
            }
        </script>

    <div id='cssmenu'>
            <ul>
            <li style="margin-left: 290px"><a href='index.php'><span>Ingresar vehículo</span></a></li>
            <li><a href='#'><span>ordenes de trabajo</span></a></li>
            <li class='active'><a href='alumnos.php'><span>Alumnos</span></a></li>
            <li><a href='cursos.php'><span>CURSOS</span></a></li>
            <li class='last'><a href='#'><span>Contacto</span></a></li>
            <li onclick="cerrarSesion();" style="float:right" class='last'><a href='#'><span>Cerrar sesión</span></a></li>
            </ul>
            </div>
         <div class="contenedor"> 
            <main class="contenedor2">
             <div class="registro" style="display: none;">

             <div class="registrar_alumno">
                        <div class="titulo"><h2>Registrar Alumno<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo">
                    <form onsubmit="return enviar2();" method="post" class="formulario">
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
                    </div>
                    </div>
                    <div class="registro" style="display: none;">   

                    <div class="registrar_alumno2">
                        <div class="titulo"><h2>Añadir Alumnos via Excel<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo2">
                    <form class="formulario" method="post" id="form_archivo" name="archivos" enctype='multipart/form-data'>
                        <label>Archivo</label>
                        <input type="file" name="archivo" class="archivo">
                        <label>Fecha</label>
                        <input id="fecha" type="date" required>
                        <div class="botones">
                            <input type="submit" value="Subir" class="grabar">
                            <input type="reset" value="Limpiar" class="limpiar">
                        </div>
                        <div id="respa2"></div>
                    </form>       

                    </div>
                    </div>


                    <div class="registro" style="display: none;">   

                    <div class="registrar_alumno3">
                        <div class="titulo"><h2>Añadir Alumnos a Cursos<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo3">
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
                            $rut = $_SESSION['rut'];
                            require('../../conexion.php');
                            $consulta2 = "SELECT curso.idcurso, NOMBRECURSO from curso inner join profesor_curso on profesor_curso.IDCURSO = curso.IDCURSO where
                            profesor_curso.RUTPROFESOR = $rut";
                            $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");
                            $cantidad = mysqli_num_rows($resultset);
                            echo "<select id='cursos' name='cursos' multiple size='".$cantidad."'>";
                            while($fila=mysqli_fetch_array($resultset)) {
                                echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
                            }
                            ?>
                        </select>
                        <label>Fecha</label>
                        <input id="fecha" type="date">
                        <div class="botones">
                            <input type="submit" value="Grabar" class="grabar">
                            <input type="reset" value="Limpiar" class="limpiar">
                        </div>
                        <div id="respa3"></div>
                    </form>     

                    </div>
                    </div>



                    <div class="registro" style="display: none;">   
                    <div class="registrar_alumno4">
                        <div class="titulo"><h2>Añadir Alumnos a Cursos VIA EXCEL<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo4">
                    <form method="post" class="formulario" id="form_archivo2" name="archivos2" enctype='multipart/form-data'>
                    <label>Curso/s (Para seleccionar mas de un curso presione las teclas: Ctrl + Click)</label>
                                <?php
                                require('../../conexion.php');
                                $consulta3 = "SELECT curso.idcurso, NOMBRECURSO from curso inner join profesor_curso on profesor_curso.IDCURSO = curso.IDCURSO where
                                profesor_curso.RUTPROFESOR = $rut";

                                $resultset2 = mysqli_query($link, $consulta3) or die ("Error en la consulta");
                                $cantidad2 = mysqli_num_rows($resultset2);
                                echo "<select id='cursos_excel' name='cursos'>";
                                while($fila=mysqli_fetch_array($resultset2)) {
                                    echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
                                }
                                ?>
                            </select>
                    <label>Archivo</label>
                        <input type="file" name="archivo" class="archivo">
                        <label>Fecha</label>
                        <input id="fecha" type="date" required>
                        <div class="botones">
                            <input type="submit" value="Subir" class="grabar">
                            <input type="reset" value="Limpiar" class="limpiar">
                        </div>
                        <div id="respa4"></div>
                    </form>

                    </div>
                    </div>
                    
                    <section class="registro" style="display: none;">   
                    <div class="registrar_alumno5">
                        <div class="titulo"><h2>Gestionar alumnos<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo5">
                    <form method="post" class="formulario">
               
                        <table id="tabla" class="tabla">
                            <thead>
                                <tr>
                                    <th>Rut</th>
                                    <th>Nombres</th>
                                    <th>Correo del alumno</th>
                                    <th>Ap.Paterno</th>
                                    <th>Ap.Materno</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                require('../../conexion.php');
                                $consulta2 = "SELECT curso.idcurso from curso inner join profesor_curso on profesor_curso.IDCURSO = curso.IDCURSO where
                                profesor_curso.RUTPROFESOR = $rut";
                                $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");

                                while($fila=mysqli_fetch_array($resultset)) {
                                    $consulta3 = "SELECT * from alumno inner join alumno_curso on alumno_curso.rutalumno = alumno.rutalumno where
                                    alumno_curso.idcurso = $fila[0]";
                                    $resultset2 = mysqli_query($link, $consulta3) or die ("Error en la consulta");
                                        
                                    while($fila=mysqli_fetch_array($resultset2)) {
                                        echo "<tr>";
                                        echo "<td>" .$fila[0]. "</td>";
                                        echo "<td>" .$fila[1]. "</td>";
                                        echo "<td>" .$fila[2]. "</td>";
                                        echo "<td>" .$fila[3]. "</td>";
                                        echo "<td>" .$fila[4]. "</td>";
                                        echo "<td><img class='eliminar' name= '" .$fila[1]. "' src='../../img/delete.png' id='" .$fila[0]. "' onClick='eliminar(this);' alt='Eliminar'/>
                                        <img class='editar' name= '" .$fila[1]. "' src='../../img/edit.png' id='" .$fila[0]. "' onClick='editar(this);' alt='Editar'/></td>"; 
                                        echo "</tr>";
                                    }
                                }
                                
                                ?>
                            </tbody>
                            </table>
                            
                        <div id="respa"></div>
                    </form>
                            </div>
                            </section>
            </main>
            <!--<footer>
            </footer>-->
        </div>
    </body>
</html>
