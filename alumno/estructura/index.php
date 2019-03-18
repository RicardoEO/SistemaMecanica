<?php
session_start();
if (isset($_SESSION['privilegio'], $_SESSION['email'])) {
    if ($_SESSION['privilegio'] != 3) {
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
        <link rel="stylesheet" href="../../css/style_profesor.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    </head>
    <style>
        #actual {
            background-color: #262626;
        }
    </style>
    <body>
        <script type="text/javascript">

            

            $(document).ready(function(){
                $(".registro").fadeIn(800);
                $(".registrar_dueño").click(function() 
            {
                $(".cuerpo").slideToggle("slow");
            });

               $(".registrar_dueño2").click(function() 
            {
                $(".cuerpo2").slideToggle("slow");
            });

            
            $("#marca_auto").change(function() {
                var i = 0;
                $("#modelo_auto").empty();
                var id= this.value;
                $.ajax({
                    type: 'post',
                    url: 'combo.php',
                    data: 'id=' + id,
                    dataType: 'json',
                    success:function(resp) {
                        console.log(resp[3]);
                        console.log(resp);
                        for(var i=0;i<=resp[resp.length-1];i = i + 2) {
                            $('#modelo_auto').append( '<option value="'+resp[i]+'">'+resp[i+1]+'</option>' );
                        } 

                    },
                    error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
                });
            });

            });



            function enviar() {
                var rut_dueño = document.getElementById('rut_dueño').value;
                var nombres_dueño = document.getElementById('nombres_dueño').value;
                var ap_p_dueño = document.getElementById('ap_p_dueño').value;
                var ap_m_dueño = document.getElementById('ap_m_dueño').value;
                var telefono_dueño = document.getElementById('telefono_dueño').value;

                var dataen = 'rut_dueño='+rut_dueño +'&nombres_dueño='+nombres_dueño + '&ap_p_dueño='+ap_p_dueño + '&ap_m_dueño='+ap_m_dueño + '&telefono_dueño='+ telefono_dueño;

                $.ajax({
                    type: 'post',
                    url: '../registros/reg_dueño.php',
                    data: dataen,
                    success:function(resp) {
                        $("#respa").html(resp);
                    }
                });
            return false;
            }

            $(function(){
                $("#formulario").on("submit", function(e){
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("formulario"));
                var alumnos = $("#alumnos").val();
                formData.append("alumnos", JSON.stringify(alumnos));
                var fecha_grupo = document.getElementById('fecha_grupo').value;
                formData.append("fecha_grupo", fecha_grupo);
                var nombre_auto = document.getElementById('nombre_auto').value;
                formData.append("nombre_auto", nombre_auto);
                var patente_auto = document.getElementById('patente_auto').value;
                formData.append("patente_auto", patente_auto);
                var marca_auto = document.getElementById('marca_auto').value;
                formData.append("marca_auto", marca_auto);
                var modelo_auto = document.getElementById('modelo_auto').value;
                formData.append("modelo_auto", modelo_auto);
                var año_auto = document.getElementById('año_auto').value;
                formData.append("año_auto", año_auto);
                var km_auto = document.getElementById('km_auto').value;
                formData.append("km_auto", km_auto);
                var chasis = document.getElementById('chasis').value;
                formData.append("chasis", chasis);
                var vin = document.getElementById('vin').value;
                formData.append("vin", vin);
                var sintomas = document.getElementById('sintomas').value;
                formData.append("sintomas", sintomas);

                $.ajax({
                        url: '../registros/reg_vehiculo.php',
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
            <div id='cssmenu'>
            <ul>
            <li style="margin-left: 290px" class='active'><a href='index.php'><span>Ingresar vehículo</span></a></li>
            <li><a href='ordenes_de_trabajo.php'><span>ordenes de trabajo</span></a></li>
            <li><a href='cursos.php'><span>CURSOS</span></a></li>
            <li class='last'><a href='#'><span>Contacto</span></a></li>
            <li onclick="cerrarSesion();" style="float:right" class='last'><a href='#'><span>Cerrar sesión</span></a></li>
            </ul>
            </div>
        <div class="contenedor">
            <main class="contenedor2">
             <div class="registro" style="display: none;">   

                    <div class="registrar_dueño">
                        <div class="titulo"><h2>Registrar Dueño<img class="flecha" src="../../img/arrow.png"></h2></div>
                    </div>
                    <div class="cuerpo">
                    <form onsubmit="return enviar();" method="post" class="formulario">
                        <label>Rut Dueño</label><input id="rut_dueño" class="carrera" type="text" required>
                         <label>Nombres</label><input type="text" id="nombres_dueño" required>
                         <label>Apellido Paterno</label><input type="text" id="ap_p_dueño" required>
                         <label>Apellido Materno</label><input type="text" id="ap_m_dueño" required>
                         <label>Telefono</label><input type="number" id="telefono_dueño" required>
                        <div class="botones">
                            <input type="submit" value="Grabar" class="grabar">
                            <input type="reset" value="Limpiar" class="limpiar">
                        </div>
                        <div id="respa"></div>
                    </form>        
                    
        </div>
        </div>
                    <div class="registro" style="display: none;">   

                    </div>
          
            </main>
            <!--<footer>
            </footer>-->
        </div>
    </body>
</html>