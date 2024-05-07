<?php

/* Este php recoge los datos de las visitas segun quien tenga iniciada la sesion, entonces printara
    con el echo todas las listas con boostrap, tambien asignandole a el boton cada id de la cita asi para luego
    poder borrar más facilmente las citas que se printan. */

session_start();
include 'conexion_be.php';

$query = "SELECT ci.idCita, pe.nombre AS nombreCliente, per.nombre AS nombreTrabajador, ci.fecha, ci.hora, ci.descripcion  
          FROM cliente c 
          JOIN cita ci ON (c.idCliente = ci.idCliente) 
          JOIN personal t ON (ci.idTrabajador = t.idTrabajador) 
          JOIN persona pe ON (c.DNI = pe.DNI) 
          JOIN persona per ON (t.DNI = per.DNI) 
          WHERE c.DNI = '$_SESSION[usuario]' AND ci.fecha >= CURDATE()
          ORDER BY ci.fecha, ci.hora";

$result = mysqli_query($conexion, $query);

echo '<div id="citasContainer">';

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $idCita = $row['idCita'];
        $fecha_formateada = date("d-m-Y", strtotime($row['fecha']));
        echo '<div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><strong>Medico: </strong>' . $row['nombreTrabajador'] . '</h5>
                    <small><strong>' . $fecha_formateada . ' ' . $row['hora'] . '</strong></small>
                </div>
                <p class="mb-1" style="word-wrap: break-word;">' . $row['descripcion'] . '</p>
                <small><strong>Cliente: </strong>' . $row['nombreCliente'] . '</small>
<button style="margin-left: auto; margin-bottom: 20px; padding: 8px; display: block;" class="btn btn-danger btn-sm" onclick="borrarCita(' . $idCita . ')">Anular</button>
                <div id="eliminar"></div>
            </div>';
    }
} else {
    echo '<p><strong>No hay visitas programadas.</strong></p>';
}

echo '</div>'; // Cierre del contenedor
?>