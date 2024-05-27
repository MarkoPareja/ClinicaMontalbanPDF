<?php 
session_start();
require('database.php');

// Crear una instancia de la clase Database
$database = new Database();

    // Obtener los datos de visita
    $datosVisitas = $database->listaVisitas();

    // Verificar si hay datos disponibles
    if (!empty($datosVisitas)) {
        foreach ($datosVisitas as $visita) {
            $idCita = $visita['idCita'];
            $fecha_formateada = date("d-m-Y", strtotime($visita['fecha']));
    ?>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><strong>Medico: </strong><?php echo $visita['nombreTrabajador'];?></h5>
                    <small><strong><?php echo $fecha_formateada . ' ' . $visita['hora'];?></strong></small>
                </div>
                <p class="mb-1" style="word-wrap: break-word;"><?php echo $visita['descripcion'];?></p>
                <small><strong>Cliente: </strong><?php echo $visita['nombreCliente'];?></small>
                <button style="margin-left: auto; margin-bottom: 20px; padding: 8px; display: block;" class="btn btn-danger btn-sm" onclick="borrarCita(<?php echo $idCita;?>)">Anular</button>
                <div id="eliminar"></div>
            </div>
    <?php 
        } 
    } else {
        // Si no hay datos, mostrar un mensaje
        echo '<p><strong>No hay visitas programadas.</strong></p>';
    }
    echo '</div>';
    ?>