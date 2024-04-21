<?php

include 'conexion_be.php';

// Verificar si hay una sesión de usuario iniciada
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

$DNI = $_SESSION['usuario'];

// Preparar la consulta
$persona = mysqli_prepare($conexion, "SELECT nombre, apellido, persona.DNI, cliente.TSI, telefono, direccion FROM persona JOIN cliente ON cliente.DNI=persona.DNI WHERE persona.DNI = ?");
mysqli_stmt_bind_param($persona, "s", $DNI);
mysqli_stmt_execute($persona);
mysqli_stmt_bind_result($persona, $nombre, $apellido, $dni, $tsi, $telefono, $direccion);
mysqli_stmt_fetch($persona);

// Definir variables para almacenar los resultados de la consulta


// Obtener resultados
mysqli_stmt_fetch($persona);

?>
