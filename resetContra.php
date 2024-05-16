<?php

include "php/getToken.php"

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesion/Registro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="https://db.onlinewebfonts.com/c/150037e11f159dca84bc4c04549094b6?family=Averta-Regular" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/login_style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- |||| Inicio Sesion |||| -->
    <div class="container-form login">
        <div class="information">
            <div class="info-childs">
                    <a href="index.php">
                    <img src="/assets/img/LOGO-COLOR.png" width="120px" height="120px"> 
                </a>
                <h2>Recuperación</h2>
                <p>Podrás cambiar tu contraseña por una nueva en el caso de la perdida de esta</p>
                <p class="info-negrita-login">Acuerdate de la nueva!</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Restablecer contraseña</h2>
                <p>Introduce tu nueva contraseña</p>
                <form action="php/updatePass.php" method="POST" class="form" id="resetForm">
                    <label class="passwordeye">
                        <i class='bx bx-lock' ></i>
                        <input type="password" placeholder="Nueva contraseña" name="contrasena" maxlength="50" required id="password-field-reset">
                        <div class="eye" id="toggle-password-reset">
                            <i class='bx bxs-hide'></i>
                        </div>
                    </label>
                    <label class="passwordeye">
                        <i class='bx bx-lock' ></i>
                        <input type="password" placeholder="Vuelve a introducir" name="contrasena" maxlength="50" required id="password-field-reset2">
                        <input type="hidden" name="token" value="<?php echo $token?>">

                        <div class="eye" id="toggle-password-reset2">
                            <i class='bx bxs-hide'></i>
                        </div>
                    </label>
                    <br>
                    <input id="botonReset" type="button" value="Cambiar contraseña" onclick="validarContraseñas()">
                    <br><br>
                    <p><a href="/login.php">¿Quieres volver al inicio?</a></p>
                    <br><br>
                    <p id="errorCorreo" style="color: red;"><?php $error;?></p>
                </form>
                <p id="mensajeError" style="color: red; display: none;">Las contraseñas no coinciden.</p>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/resetScript.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener el mensaje de error de localStorage
            var error = localStorage.getItem('error');
            if (error) {
                // Mostrar el error en el elemento con id 'errorCorreo'
                document.getElementById('errorCorreo').innerText = error;
                // Limpiar el error de localStorage para futuras visitas
                localStorage.removeItem('error');
            }
        });
    </script>
</body>
</html>