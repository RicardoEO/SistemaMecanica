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
    <form id="form_editar" class="form_editar" method="post">
    <label>Id de orden de trabajo</label>
    <input id="id" name="id" type="number">
    <label>Nombre</label>
    <input id="nombre" name="nombre" type="text">
    <label>Id Automovil</label>
    <input id="id_automovil" name="id_automovil" type="text">
    <label>Rut profesor</label>
    <input id="rut_profesor" name="rut_profesor" type="text">
    <label>Fecha de creacion</label>
    <br>
    <input id="fecha_creacion" name="fecha_creacion" type="date">
    <br>
    <label>Estado</label>
    <input id="estado" name="estado" type="text">
    <input type="submit" value="Modificar">
    <input type="reset" value="Limpiar">
    <div id="respa5">sd</div>
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
            
            $("#form_editar").on("submit", function(e){
                    e.preventDefault();
                    var f = $(this);
                    var formData = new FormData(document.getElementById("form_editar"));
                    var id = document.getElementById('id').value;
                    formData.append("id", id);
                    var nombre = document.getElementById('nombre').value;
                    var id_automovil = document.getElementById('id_automovil').value;
                    formData.append("id_automovil", id_automovil);
                    var rut_profesor = document.getElementById('rut_profesor').value;
                    formData.append("rut_profesor", rut_profesor);
                    var fecha_creacion = document.getElementById('fecha_creacion').value;
                    formData.append("fecha_creacion", fecha_creacion); 

       

                    $.ajax({
                        url: "../gestionar/actualizar_ot.php",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                        .done(function(res){
                            $("#respa5").html("Respuesta: " + res);
                        });
                });
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


            function enviar() {
                var id = document.getElementById('id').value;
                var ramo = document.getElementById('ramo').value;
                var nombre_curso = document.getElementById('nombre_curso').value;
                var seccion = document.getElementById('seccion').value;
                var año = document.getElementById('año').value;
                var semestre = document.getElementById('semestre').value;

                var dataen = 'id='+id +'&ramo='+ramo + '&nombre_ramo='+nombre_ramo + '&seccion=' + seccion + '&año=' + año + '&semestre=' + semestre;

                $.ajax({
                    type: 'post',
                    url: '../registros/reg_cursos.php',
                    data: dataen,
                    success:function(resp) {
                        $("#respa").html(resp);
                    }
                });
            
            return false;
            }

            function eliminar(_this) {
                var dataen = 'id='+_this.id;
                var statusConfirm = confirm("¿Desea eliminar la orden de trabajo " + _this.id + "?");
                if (statusConfirm == true) {
                    $.ajax({
                        type: 'post',
                        url: '../registros/eliminar_ot.php',
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
                var dataen = 'id='+ _this.id;
                    $.ajax({
                        type: 'post',
                        url: '../gestionar/ordenes_de_trabajo.php',
                        data: dataen,
                        success:function(resp) {
                            resultado = JSON.parse(resp);
                            $('#id').val(resultado[0]);
                            $('#nombre').val(resultado[1]);
                            $('#id_automovil').val(resultado[2]);
                            $('#rut_profesor').val(resultado[3]);
                            $('#fecha_creacion').val(resultado[4]);
                            $('#estado').val(resultado[5]);
                            $('#myModal').css("display", "block");
                        }
                    });
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                $('#myModal').css("display", "none");
                
            }

            function generarPdf(_this) {
                var dataen = 'id='+ _this.id;
                    $.ajax({
                        type: 'post',
                        url: '../registros/generar_pdf.php',
                        data: dataen,
                        success:function(resp) {
                            alert(resp);
                            window.open('../registros/archivos/ot.pdf', '_blank');  
                        }
                    });
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
            <li class="active"><a href='#'><span>ordenes de trabajo</span></a></li>
            <li><a href='alumnos.php'><span>Alumnos</span></a></li>
            <li><a href='cursos.php'><span>CURSOS</span></a></li>
            <li class='last'><a href='#'><span>Contacto</span></a></li>
            <li style="float:right" class='last'><a href='#'><span>Cerrar sesión</span></a></li>
            </ul>
            </div>
         <div class="contenedor"> 
            <main class="contenedor2">
            <section class="registro" style="display: none;">   
                    <div class="registrar_alumno5">
                        <div class="titulo"><h2>Ver ordenes de trabajo<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo5">
                    <form method="post" class="formulario">
               
                        <table id="tabla" class="tabla">
                            <thead>
                                <tr>
                                    <th>Id ot</th>
                                    <th>Automovil</th>
                                    <th>Grupo</th>
                                    <th>Nombre ot</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                require('../../conexion.php');
                                $consulta2 = "SELECT * from ordendetrabajo";
    
                                $resultset = mysqli_query($link, $consulta2) or die ("Error en la consulta");
    
                                while($fila=mysqli_fetch_array($resultset)) {
                                    echo "<tr>";
                                    echo "<td>" .$fila['ID_OT']. "</td>";
                                    $consulta3 = "SELECT id_modelo from automovil where idautomovil = $fila[ID_OT]";
                                    $resultset2 = mysqli_query($link, $consulta3) or die ("Error en la consulta2");
                                    $id_modelo = mysqli_fetch_array($resultset2);
                                    $consulta4 = "SELECT nombremodelo from modelo where id_modelo = $id_modelo[0]";
                                    $resultset3 = mysqli_query($link, $consulta4) or die ("Error en la consulta");
                                    $modelo = mysqli_fetch_array($resultset3);
                                    echo "<td>" .$modelo[0]. "</td>";
                                    echo "<td>" .$fila['GRU_ID_GRUPO']. "</td>";
                                    echo "<td>" .$fila['NOMBRE_OT']. "</td>";
                                    echo "<td>" .$fila['ESTADO']. "</td>";
                                    echo "<td>" .$fila['FECHA_CREACION']. "</td>";
                                    echo "<td><img class='eliminar' name= '" .$fila[3]. "' src='../../img/delete.png' id='" .$fila[0]. "' onClick='eliminar(this);' alt='Eliminar'/>
                                    <img class='editar' name= '" .$fila[3]. "' src='../../img/edit.png' id='" .$fila[0]. "' onClick='editar(this);' alt='Editar'/>
                                    <img class='eliminar' name= '" .$fila[3]. "' src='../../img/archivos.png' id='" .$fila[0]. "' onClick='generarPdf(this);' alt='Eliminar'/></td>"; 
                                    echo "</tr>";
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
