<!DOCTYPE html>
<html lang="es">
<?php

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../login.php");
        exit;
    }
include 'php/getDatosCuenta.php';
require_once('php/database.php');

// Crear una instancia de la clase Database
$database = new Database();
$usuario = $database->comprovacionTrabajador($_SESSION['usuario']);
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Montalban</title>
    <link rel="stylesheet" href="/assets/css/client_style.css">
    <link href="https://db.onlinewebfonts.com/c/150037e11f159dca84bc4c04549094b6?family=Averta-Regular" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/logo-ico.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/hjsCalendar.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
      <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>
  <div id="container-alerta" class="hide">
    <div class="alert alert-dismissible fade show alert-success d-flex align-items-center alerta" role="alert">
    <svg class="bi flex-shrink-0 me-2 alerta-boton" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div id="responsecuenta"></div>
    <button type="button" class="btn-close boton-cerrar" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>
    <header>
        <div id="espacio-blanco" style="width: 100px;">
            &nbsp;
        </div>
        <div class="logo-clinica">
            <a href="index.php">
                <div style="margin-top: 10px; margin-left: 15px;"><img src="/assets/img/LOGO-COLOR.png" width="80px"
                        height="80px" alt="LOGOTIPO DE LA EMPRESA"></div>
            </a>
            <div class="titulo">Clinica</div>
            <div class="titulo2">Montalban</div>
        
        </div>
        <div class="btn-group">
            <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bienvenido, <?php echo $nombre ?>!
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Inicio</a></li>
                <li><a class="dropdown-item" href="cuenta.php">Modificar Cuenta</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="php/cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
        

    </header>
<?php if($usuario[0]['usuario'] === 0){ ?>
    <section class="title-top">
        <h1>Selección de servicios</h1>
    </section>

    <!-- Button trigger modal -->
    <div class="modals">
        <!-- |||| Para que los dos bloques esten juntos |||| -->
        <div class="juntos">

            <!-- Modal de Cita -->
            <div class="modal fade" id="cita" tabindex="-1" aria-labelledby="cita" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="titulo-cita">Calendario de citas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <!-- Aquí printara el pre-calendario como primer div -->
                                <div class="pre-calendar" id="pre-calendar">
                                    <form method="POST" class="form" id="citaForm">
                                        <h2><strong>Rellena el informe</strong></h2>
                                        <p>Aquí podrás escoger la <strong>especialidad y el medico</strong> que necesites además de escribir el <strong>motivo.</strong></p>
                                        <p>Recuerda que si te has equivocado de medico o quieres añadir más información del motivo de la cita en el calendario <strong>puedes volver a esta sección.</strong></p>
                                        <br>
                                        <h3>Motivo de la cita</h3>
                                        <label>
                                            <textarea id="motivo" name="motivo" cols="38" rows="5" style="border:3px solid #00FF00; resize: none;" placeholder="Cuentanos que sucede..." maxlength="1000"></textarea>
                                        </label>
                                        <br/>

                                        <div id="medicosDropdown">
                                            <h3 class="segundo-titulo-precalendar">Elige la especialidad de la lista</h3>                                            
                                        <div class="container">
                                            <div class="dropdown">
                                                <div class="select">
                                                <span>Seleccionar Médico</span>
                                                <i class="fa fa-chevron-left"></i>
                                                </div>
                                                <input type="hidden" name="gender">
                                                <ul class="dropdown-menu">                                
                                            <?php
                                                //echo "<option selected>Seleccionar Médico</option>";
                                                $medicos = $database->listaMedicos();
                                                if (!empty($medicos)) {
                                                    foreach ($medicos as $consul) {
                                                        $idTrabajador = $consul['idTrabajador'];
                                                        $nombre = $consul['nombre'];
                                                        $apellido = $consul['apellido'];
                                                        $descripcion = $consul['descripcio'];
                                                        echo "<li name='medico' id='medico_$idTrabajador' value='$idTrabajador'><strong>$nombre $apellido</strong>: $descripcion</li>";
                                                    }
                                                } else {
                                                    echo "<li>No hay médicos disponibles.</li>";
                                                }
                                            ?>
                                                </ul>
                                                </div>
                                            <span class="msg"></span>
                                            </div>
                                        </div>
                                        <br/>
                                        <div id="comparar-valores"></div>
                                        <div class="modal-footer pre-calendar-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Pedir hora</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Aquí printara el calendario accionado por el JavaScript -->
                                <div id="calendar" style="display: none;">
                                    <div id="hjsCalendar"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-info" onclick="volverFormulario()">Volver Atrás</button>
                                    </div>
                                </div>

                                <!-- Aquí printará una vez finalizemos la cita -->
                                <div id="calendar-finish" style="display: none;">
                                    <div id="calendar-finish-details">
                                        <!-- Los detalles de la cita se mostrarán aquí -->
                                    </div>
                                    <div id="modal-footer-calendar" class="modal-footer">
                                        <button id="generarJSON" type="button" class="btn btn-info" data-bs-dismiss="modal" onclick="recargarPagina()">Cerrar la ventana</button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Carta de Cita -->
            <div class="card" style="width: 18rem; max-width: 100%;">
                <img src="assets/img/calendario-clinica.jpg" class="card-img-top" alt="Cita - Medico de cabecera">
                <div class="card-body">
                    <h5 class="card-title">Medico de cabecera</h5>
                    <p class="card-text">Calendario en tiempo real. Puedes solicitar varias citas al día!</p>
                    <a href="#" id="generarJSON" class="btn btn-primary" onclick="$('#cita').modal('show');">Abrir Calendario</a>
                </div>
            </div>

            <!-- Modal de Visitas-->
            <div class="modal fade" id="visitas" tabindex="-1" aria-labelledby="visitas" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Visitas Programadas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="generarVisitas"></div>
                            <!-- Modal de Confirmación -->

                            <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmacionModalLabel"><strong>Confirmar Eliminación</strong></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="confirmacionMensaje">¿Estás seguro de que quieres eliminar esta cita?</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Carta de Visita (vertical) -->
            <div class="card" style="width: 18rem; max-width: 100%;">
                <img class="card-img-top" src="assets/img/visitas-programadas.jpg" alt="Visitas Programadas">
                <div class="card-body">
                    <h5 class="card-title">Visitas Programadas</h5>
                    <p class="card-text">Comprueba tus citas pendientes i/o elimina la cita.</p>
                    <a href="#" id="visitasBtn" class="btn btn-primary" onclick="$('#visitas').modal('show');">Abrir Visitas</a>
                </div>
            </div>
        </div>

        <div class="juntos">

            <!-- Modal de Informe -->
            <div class="modal fade" id="informe" tabindex="-1" aria-labelledby="informe" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="titulo-cita">Informes de las visitas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <?php 
                            // Obtener los datos de visita
                            $datosVisita = $database->datosVisita($dni);

                            // Verificar si hay datos disponibles
                            if (!empty($datosVisita)) {
                                foreach ($datosVisita as $visita) {
                                    $idCliente = $database->idCliente($dni);
                                    $fecha_formateada = date("d-m-Y", strtotime($visita['fecha']));
                            ?>
                                    <ul class="list-group list-group-item-action">
                                        <li class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><strong>Medico: </strong><?php echo $visita['nombre'] ?></h5>
                                                <small><strong><?php echo $fecha_formateada; echo "   ".$visita['hora'] ?></strong></small>
                                            </div>
                                            <p class="mb-1" style="word-wrap: break-word;">Motivo consulta: <?php echo $visita['descripcion']?></p>
                                            <!-- Formulario para cada visita -->
                                            <form action="pdfGen.php" method="post" target="_blank">
                                                <input type="hidden" name="cliente" value="<?php echo $idCliente[0]['idCliente']?>">
                                                <input type="hidden" name="cita" value="<?php echo $visita['idCita']?>">
                                                <!-- Botón de Descargar PDF dentro del formulario -->
                                                <button type="submit" style="margin-left: auto; margin-bottom: 20px; padding: 8px; display: block;" class="btn btn-primary btn-sm">Descargar</button>
                                            </form>
                                        </li>
                                    </ul>     
                                    <br>         
                            <?php 
                                } 
                            } else {
                                // Si no hay datos, mostrar un mensaje
                                echo '<p><strong>No hay visitas realizadas.</strong></p>';
                            }
                            ?>

                        </div>


                        <script>
                            function enviarFormulario(btn) {
                                var form = btn.closest('form'); // Encuentra el formulario asociado al botón
                                form.submit(); // Envía ese formulario
                            }
                        </script>

                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carta de informe -->
            <div class="card" style="width: 18rem; max-width: 100%;">
                <img src="assets/img/clinica-cita.jpg" class="card-img-top" alt="informe">
                <div class="card-body">
                    <h5 class="card-title">Informes de las visitas</h5>
                    <p class="card-text">Aquí podras comprobar los expedientes de las visitas que has hecho</p>
                    <a href="#" class="btn btn-primary" onclick="$('#informe').modal('show');">Abrir Informes</a>
                </div>
            </div>

        </div>
    </div>
<?php } else if($usuario[0]['usuario'] === 1) { ?>
    <section class="title-top">
        <h1>Descargate la aplicacion</h1>
    </section>
    <div class="container">
        <a href="assets/aplicacion/ClinicaMontalban.exe" class="download-button" id="windows" onclick="showtext('mostrar-windows')" download>
            <img src="assets/img/windows.png" alt="Windows Logo">
            Descargar para Windows
        </a>
        <a href="assets/aplicacion/ClinicaMontalban-1.0-SNAPSHOT-shaded.jar" class="download-button linux-button" id="linux" onclick="showtext('mostrar-linux')" download>
            <img src="assets/img/linux.svg" alt="Linux Logo">
            Descargar para Linux
        </a>
        <div id="mostrar-windows" class="hide">
            <br>
            <hr>
            <br>
            <h2>Pasos para realizar la instalación</h2>
            <p class="card-text">Sigue correctamente los pasos para que la aplicacion se ejecute correctamente</p>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item"><a href="https://javadl.oracle.com/webapps/download/AutoDL?BundleId=249833_43d62d619be4e416215729597d70b8ac">Instalar JAVA 8+ (Version 8 o posterior)</a></li>
                <li class="list-group-item"><a href="https://download.oracle.com/java/17/latest/jdk-17_windows-x64_bin.exe">Instalar JAVA JDK 17.0.1+ (Version 17.0.1 o posterior)</a></li>
                <li class="list-group-item">Ejecutar aplicación</li>
            </ol>
        </div>
        <div id="mostrar-linux" class="hide">
            <br>
            <hr>
            <br>
            <h2>Pasos para realizar la instalación</h2>
            <p class="card-text">Sigue correctamente los pasos para que la aplicacion se ejecute correctamente</p>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">
                    Instalar JAVA 8+ (Version 8 o posterior)
                    <div class="code-container-parent">
                        <div class="code-container" id="code1">
                            <button class="copy-button" onclick="copyToClipboard('code-block1')">Copiar</button>
                            <pre id="code-block1">sudo apt install openjdk-19-jre-headless</pre>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    Instalar JAVA OPENJFX 
                    <div class="code-container-parent">
                        <div class="code-container" id="code2">
                            <button class="copy-button" onclick="copyToClipboard('code-block2')">Copiar</button>
                            <pre id="code-block2">sudo apt install openjfx</pre>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    Ejecutar aplicación 
                    <div class="code-container-parent">
                        <div class="code-container" id="code3">
                            <button class="copy-button" onclick="copyToClipboard('code-block3')">Copiar</button>
                            <pre id="code-block3">java --module-path /usr/share/openjfx/lib --add-modules javafx.controls,javafx.fxml -jar ClinicaMontalban-1.0-SNAPSHOT-shaded.jar</pre>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
   

<?php } ?>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src='assets/js/hjsCalendar.min.js'></script>
<?php if($usuario[0]['usuario'] === 0) { 
    echo "<script src='assets/js/hjsCalendar.min.js'></script>";
    echo "<script src='assets/js/generarVisitas.js'></script>";
    echo "<script src='assets/js/almVisitas.js'></script>";
    echo "<script src='assets/js/clienteScript.js'></script>";
} ?>
    <script src="assets/js/scriptModal.js"></script>
    <script src="assets/js/borrarCita.js"></script>
    <script>
        /*Dropdown Menu*/
$('.dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('.dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('.dropdown .dropdown-menu li').click(function () {
    var id = $(this).attr('id');
    var text = $(this).text();
    var input = $(this).closest('.dropdown').find('input:first');

    // Obtener valores personalizados si existen, de lo contrario, usar el id
    var value = $(this).attr('value');

    // Establecer el id, el value y el name del input
    input.attr('id', id);
    input.attr('value', value);
    input.attr('name', "medico");

    // Actualizar el texto del span con el texto del elemento de la lista clicado
    $(this).closest('.dropdown').find('span').text(text);
});
/*End Dropdown Menu*/
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("container-alerta").classList.add("hide");
            // Obtener el mensaje de error de localStorage
            var token = localStorage.getItem('cuenta');
            if (token) {
                // Mostrar el token en el elemento con id 'errorCorreo'
                document.getElementById('responsecuenta').innerText = token;
                // Limpiar el token de localStorage para futuras visitas
                localStorage.removeItem('cuenta');
                activarResponse();
                setTimeout(desactivarResponseFade, 5000);
                window.addEventListener('wheel', desactivarResponse); 
            }
            else{
              desactivarResponse();
            }

            
        });

        function copyToClipboard(id) {
            const codeBlock = document.getElementById(id).innerText;
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = codeBlock;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand('copy');
            document.body.removeChild(tempTextArea);
        }

        function showtext(app) {
        let hideElements = document.getElementsByClassName("hide-recovery");
        for (let element of hideElements) {
            element.classList.remove("hide-recovery");
            element.classList.add("hide");
        }

        let alert = document.getElementById(app);
        alert.classList.remove("hide");
        alert.classList.add("hide-recovery");
        alert.style.visibility = "visible"; // Asegura que el elemento esté visible
    }

        function activarResponse(){
          let alert = document.getElementById("container-alerta");
            alert.classList.remove("hide");
            alert.classList.add("hide-recovery");
            alert.style.visibility = "visible"; // Asegura que el elemento esté visible
        }

        function desactivarResponse(){
          let alert = document.getElementById("container-alerta");
          alert.classList.remove("hide-recovery");
          alert.classList.add("hide");
        }

        function desactivarResponseFade(){
          let alert = document.getElementById("container-alerta");
          alert.classList.remove("hide-recovery");
          alert.classList.add("fade-out");
            setTimeout(() => {
              alert.classList.add("hide");
            }, 900);
        }
    </script>
</body>
<style>
.code-container-parent {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.code-container {
    position: relative;
    background: #282c34;
    color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    /*width: fit-content;*/
}
#code-block1{
    margin-left: -50px;
    width: 400px;
}
#code-block2{
    margin-left: -50px;
    width: 400px;
}

#code-block3{
    margin-left: -50px;
    width: 1000px;
}
pre {
    margin: 0;
    font-size: 14px;
}

.copy-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #61dafb;
    border: none;
    color: #000;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.copy-button:hover {
    background: #21a1f1;
}

span.msg,
span.choose {
  color: #555;
  padding: 5px 0 10px;
  display: inherit
}


/*Styling Selectbox*/
.dropdown {
  width: 300px;
  display: inline-block;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 0 2px rgb(204, 204, 204);
  transition: all .5s ease;
  position: relative;
  font-size: 16px;
  color: #474747;
  height: 100%;
  text-align: left
}
.dropdown .select {
    cursor: pointer;
    display: block;
    padding: 10px
}
.dropdown .select > i {
    font-size: 15px;
    color: #888;
    cursor: pointer;
    transition: all .3s ease-in-out;
    float: right;
    line-height: 20px
}
.dropdown:hover {
    box-shadow: 0 0 4px rgb(204, 204, 204)
}
.dropdown:active {
    background-color: #f8f8f8
}
.dropdown.active:hover,
.dropdown.active {
    box-shadow: 0 0 4px rgb(204, 204, 204);
    border-radius: 2px 2px 0 0;
    background-color: #f8f8f8
}
.dropdown.active .select > i {
    transform: rotate(-90deg)
}
.dropdown .dropdown-menu {
    position: absolute;
    font-size: 15px;
    background-color: #fff;
    width: 100%;
    left: 0;
    margin-top: 1px;
    box-shadow: 0 1px 2px rgb(204, 204, 204);
    border-radius: 0 1px 2px 2px;
    overflow: hidden;
    display: none;
    max-height: 144px;
    overflow-y: auto;
    z-index: 9
}
.dropdown .dropdown-menu li {
    padding: 10px;
    transition: all .2s ease-in-out;
    cursor: pointer
} 
.dropdown .dropdown-menu {
    padding: 0;
    list-style: none
}
.dropdown .dropdown-menu li:hover {
    background-color: #f2f2f2
}
.dropdown .dropdown-menu li:active {
    background-color: #e2e2e2
}

</style>
</html>
