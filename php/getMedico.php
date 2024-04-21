<?php

/* Esta funcion recoge de la seleccion hecha en medicos_lista.php para asi poder printar en los 
    resultados de la cita el nombre y apellido del trabajador. Nuevamente lo devuelve con echo porque
    el formato JSON me estaba dando problemas.  */

session_start();
include 'conexion_be.php';

// Obtener el idTrabajador del query string
$idTrabajador = $_GET['idTrabajador'];

$query = "SELECT p.nombre, p.apellido FROM personal pe
          INNER JOIN persona p ON pe.DNI = p.DNI
          WHERE pe.idTrabajador = ?";

$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "s", $idTrabajador);  
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nombre, $apellido);


if (mysqli_stmt_fetch($stmt)) {
    $nombreMedico = $nombre . ' ' . $apellido;
} else {
    $nombreMedico = "Médico no encontrado";
}

mysqli_stmt_close($stmt);

// Imprimir el nombre del médico directamente porque con JSON daba problemas.
echo $nombreMedico;
?>