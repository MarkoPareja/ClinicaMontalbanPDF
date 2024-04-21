<?php
include "php/getCorreo.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesion/Registro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login_style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- |||| Reset Contraseña |||| -->
    <div class="container-form login">
        <div class="information">
            <div class="info-childs">
                    <a href="index.php">
                    <img src="/assets/img/LOGO-COLOR.png" width="120px" height="120px"> 
                </a>
                <h2>Recuperación</h2>
                <p>Recupera tu cuenta introduciendo el codigo recibido en el email!</p>
                <p class="info-negrita-login">Verifica el email de la cuenta</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Verificación</h2>
                <p>Introduce el codigo del email</p>
                <form action="php/recuperacion_be.php" method="POST" class="form">
                    <label>
                        <i class='bx bxs-lock'></i>
                        <input type="number" inputmode="numeric" placeholder="Introduce el codigo de verificacón" maxlength="4" name="codigoIngresado" required>
                        <input type="hidden" name="formulario" value="codigo">
                        <input type="hidden" name="correo_recovery" value="<?php echo $correo;?>">
                    </label>
                    <br>
                    <input type="submit" value="Enviar verificación">
                    <br><br>
                    <!-- Agrega un elemento para mostrar la cuenta atrás -->
                    <div id="countdown"></div>
                    <p id="codigoExpirado" style="color: red; display: none;">Código de verificación expirado</p>
                    <br>
                    <p><a href="/login.php">¿Quieres volver al inicio?</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/temporizador.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/login_script.js"></script>
</body>

</html>