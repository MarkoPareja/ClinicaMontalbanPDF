<?php
session_start();
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCita = $_POST["idCita"];

    // Evitar inyección de SQL utilizando consultas preparadas
    $stmt = $conexion->prepare("DELETE FROM cita WHERE idCita = ?");
    $stmt->bind_param("i", $idCita);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "La cita se ha borrado exitosamente.";
    } else {
        echo "Error al borrar la cita: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    // Si la solicitud no es POST, responder con un mensaje de error
    echo "Error: Solicitud no válida.";
}
?>