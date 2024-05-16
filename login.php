<?php 
session_start();
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
                <h2>Registrate</h2>
                <p>Crea una cuenta y beneficiate de todos nuestros servicios!</p>
                <p class="info-negrita-login">Click en Registrate</p>
                <input type="button" value="Registrate" id="sign-up">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Inicia sesion</h2>
                <p>Introduce tus datos</p>
                <form action="php/login_be.php" method="POST" class="form">
                    <label>
                        <i class='bx bx-user-circle'></i>
                        <input type="text" placeholder="NIF/DNI" pattern="[0-9]{8}[A-Za-z]{1}" minlength="9" maxlength="9" name="dni" required>
                    </label>
                    <label class="passwordeye">
                        <i class='bx bx-lock' ></i>
                        <input type="password" placeholder="Contraseña" name="contrasena" maxlength="50" required id="password-field-login">
                        <div class="eye" id="toggle-password-login">
                            <i class='bx bxs-hide'></i>
                        </div>
                    </label>
                    <br>
                    <input type="submit" value="Iniciar Sesión">
                    <br><br>
                    <button class="recovery-link" id="recovery-link">¿Olvidaste tu contraseña?</button>
                    <div id="error-cuenta"></div>
                </form>
            </div>
        </div>
    </div>

    <!-- |||| Registro |||| -->
    <div class="container-form register hide">
        <div class="information">
            <div class="info-childs">
                <a href="index.php">
                    <img src="/assets/img/LOGO-COLOR.png" width="120px" height="120px"> 
                </a>
                <h2>Contactanos</h2>
                <p>inicia sesión y beneficiate de todos nuestros servicios!</p>
                <p class="info-negrita-register">Contacta para más información</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Registrate aquí</h2>
                <p>Introduce tu información</p>
                <form action="php/registro_be.php" method="POST" class="form">
                    <label>
                        <i class='bx bx-user-circle'></i>
                        <input type="text" placeholder="Nombre" name="nombre" minlength="1" maxlength="50" required>
                        <input type="text" placeholder="Apellidos" name="apellidos" minlength="1" maxlength="50" required>
                    </label>
                    <label>
                        <i class='bx bx-sidebar'></i>
                        <input type="text" placeholder="NIF/DNI" pattern="[0-9]{8}[A-Za-z]{1}" minlength="9" maxlength="9" name="dni" required>
                        <i class='bx bx-calendar'></i>
                        <input type="date" placeholder="Fecha Nacimiento" name="nacimiento" class="textbox-n" id="date-input" required>
                    </label> 
                    <label>
                        <i class='bx bx-health'></i>
                        <input type="text" placeholder="TSI" pattern="[A-Za-z]{4}\d{10}" minlength="14" maxlength="14" name="tsi" autocomplete="off" required>
                    </label>   
                    <label>
                        <i class='bx bx-envelope' ></i>
                        <input type="mail" placeholder="Correo Electronico" pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$" title="Correo no valido" name="correo" minlength="5" maxlength="50" required>
                    </label>
                    <label class="passwordeye">
                        <i class='bx bx-lock' ></i>
                        <input type="password" placeholder="Contraseña" name="contrasena" minlength="5" maxlength="50" required id="password-field">
                        <div class="eye" id="toggle-password">
                            <i class='bx bxs-hide'></i>
                        </div>
                    </label>
                    <label>
                        <i class='bx bx-phone-call'></i>
                        <span class="numbered">+34 </span>
                        <input type="text" inputmode="numeric" placeholder="Teléfono Personal" pattern="[0-9]{9}" name="telefono" id="phone-input" class="noscroll" required>
                    </label>                    
                    <label>
                        <i class='bx bx-home-alt-2'></i>
                        <input type="text" placeholder="Dirección" name="direccion" maxlength="50" required>
                    </label>
                    <input type="submit" value="Registrate">
                    <span id="age-error" style="color: red; display: none; padding: 10px">Debes ser mayor de 18 años.</span>  
                </form>
            </div>
        </div>
    </div>

    <!-- |||| Recuperar contraseña |||| -->
    <div class="container-form recovery hide-recovery">
        <div class="information">
            <div class="info-childs">
                <a href="index.php">
                    <img src="/assets/img/LOGO-COLOR.png" width="120px" height="120px"> 
                </a>
                <h2>Recuperación</h2>
                <p>Recupera tu contraseña introducciendo el correo.</p>
                <p class="info-negrita-login">Te enviaremos un correo!</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Recuperar contraseña</h2>
                <p>Introduce tu correo electronico</p>
                <form action="php/recuperacion_be.php" method="POST" class="form">
                    <label class="recovery-text">
                        <i class='bx bx-envelope' ></i>
                        <input type="text" name="correo_recovery" pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$" minlength="5" maxlength="50" placeholder="Correo Electronico" required>
                        <input type="hidden" name="formulario" value="recuperacion">
                    </label>
                    <br>
                    <input type="submit" value="Enviar">
                    <br><br>
                    <a href="">Volver</a>
                    <br><br>
                    <p id="errorCorreo" style="color: red;"><?php $error;?></p>
                </form>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/loginScript.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener el mensaje de error de localStorage
            var error = localStorage.getItem('error');
            if (error) {
                activarRecovery();
                // Mostrar el error en el elemento con id 'errorCorreo'
                document.getElementById('errorCorreo').innerText = error;
                // Limpiar el error de localStorage para futuras visitas
                localStorage.removeItem('error');
            }

            document.getElementById('recovery-link').addEventListener('click', function(event) {
                event.preventDefault();
                activarRecovery();
            });
        });

        function activarRecovery(){
            let formLogin = document.querySelector(".login");
            let formRecovery = document.querySelector(".recovery");

            formLogin.classList.add("hide");
            formRecovery.classList.remove("hide-recovery");
            formLogin.style.visibility = "hidden"; // Oculta el elemento
            formRecovery.style.visibility = "visible"; // Asegura que el elemento esté visible
        }
    </script>
</body>
</html>
