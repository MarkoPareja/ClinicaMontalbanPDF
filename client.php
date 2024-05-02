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
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Montalban</title>
    <link rel="stylesheet" href="/assets/css/client_style.css">
    <link href="https://db.onlinewebfonts.com/c/150037e11f159dca84bc4c04549094b6?family=Averta-Regular" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/logo-ico.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/hjsCalendar.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
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
                                            <textarea id="motivo" name="motivo" cols="38" rows="5" style="border:3px solid #00FF00;" placeholder="Cuentanos que sucede..." maxlength="100"></textarea>
                                        </label>
                                        <br/>

                                        <div id="medicosDropdown">
                                            <h3 class="segundo-titulo-precalendar">Elige la especialidad de la lista</h3>
                                            <?php include("php/medicosLista.php"); ?>
                                            <select class="form-select select-custom" aria-label="Seleccionar Médico">
                                            
                                            
                                            <?php
                                                echo "<option selected>Seleccionar Médico</option>";
                                                foreach ($database->listaMedicos() as $consul) {
                                                    $idTrabajador = $consul['idTrabajador'];
                                                    $nombre = $consul['nombre'];
                                                    $apellido = $consul['apellido'];
                                                    $descripcion = $consul['descripcio'];
                                                    echo "<option name='medico' id='medico_$idTrabajador' value='$idTrabajador'>";
                                                    echo "<strong>$nombre $apellido</strong>: $descripcion</option>";
                                                }

                                            ?>
                                            </select>
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
                                    <div class="modal-footer">
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
                                        <div class="modal-body" id="confirmacionMensaje">
                                            ¿Estás seguro de que quieres eliminar esta cita?
                                        </div>
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
                            foreach ($database->datosVisita($dni) as $visita) {
                                $idCliente = $database->idCliente($dni);
                                ?>
                                <ul class="list-group list-group-item-action">
                                    <li class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><strong>Medico: </strong><?php echo $visita['nombre'] ?></h5>
                                            <small><strong><?php echo $visita['fecha']; echo "   ".$visita['hora'] ?></strong></small>
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
                            <?php } ?>
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/hjsCalendar.min.js"></script>
    <script src="assets/js/clienteScript.js"></script>
    <script src="assets/js/generarVisitas.js"></script>
    <script src="assets/js/scriptModal.js"></script>
    <script src="assets/js/borrarCita.js"></script>
    <script src="assets/js/almVisitas.js"></script>
</body>

</html>
