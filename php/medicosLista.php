<?php

/* Este archivo php recoge los datos de los medicos para poder seleccionarlos en el formulario
    que crea dinamicamente y se seleccionan con el radio. */

session_start();
include 'conexion_be.php';

// Consulta a la base de datos
$consulta = "SELECT p.idTrabajador, pe.nombre, pe.apellido, e.descripcio 
             FROM personal p
             JOIN especialidad e ON p.especialidad = e.idEspecialidad
             JOIN persona pe ON p.DNI = pe.DNI";

$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    echo '<div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Seleccionar Médico
            </button>
            <ul class="dropdown-menu" style="padding: 18px">';

    while ($fila = $resultado->fetch_assoc()) {
        echo '<li class="form-check">';
        echo '<input class="form-check-input" type="radio" name="medico" id="medico_' . $fila['idTrabajador'] . '" value="' . $fila['idTrabajador'] . '">';
        echo '<label class="form-check-label" for="medico_' . $fila['idTrabajador'] . '">';
        echo '<strong>' . $fila['nombre'] . ' ' . $fila['apellido'] . '</strong>: ' . $fila['descripcio'];
        echo '</label>';
        echo '</li>';
    }

    echo '</ul>
          </div>';
} else {
    echo "No hay médicos en la base de datos.";
}
?>