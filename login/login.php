<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/login.css">
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    </head>
    <script type="text/javascript">

        $(document).ready(function(){
        $(".seccion").fadeIn(700);
        });

        function enviar() {
            //variables a enviar
            var email = document.getElementById('email').value;
            var contrasena = document.getElementById('contrasena').value;

            var dataen = 'email='+email +'&contrasena='+contrasena;

            $.ajax({
                type: 'post',
                url: 'inicio_sesion.php',
                data: dataen,
                success:function(resp) {
                    if (resp == 1) {
                        location.href ="../administrador/estructura/index.php";
                    } else if (resp == 2) {
                        location.href ="../profesor/estructura/index.php";
                    } else if (resp == 3) {
                        location.href ="../alumno/estructura/index.php";
                    } else if (resp == "Datos erroneos") {
                        $("#respa").html(resp);
                    }
                }
            });
        
        return false;
        }
    </script>
    <body>
        <div class="container">
            <section class="seccion" style="display: none;">
                <header>
                    <img src="../img/user.png">
                </header>
                    <form onsubmit="return enviar();">
                        <input type="email" id="email" class="correo" placeholder="Correo" required>
                        <input type="password" id="contrasena" class="contrasena" placeholder="Contraseña" required>
                        <input class="boton" type="submit" value="INICIAR SESIÓN">
                        <a href="#">¿Ha olvidado su contraseña?</a>
                        <div class="respa"></div>
                        <p id="respa"></p>
                    </form>
            </section>
        </div>
    </body>
</html>