<?php
include 'conexion_be.php';
session_start();

// Check if the form fields are set
if (
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['telefono']) &&
    isset($_POST['direccion'])
) {
    // Retrieve the values from the form
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Assuming you have DNI available, update this line accordingly

    // Use prepared statement to prevent SQL injection
    $updateCliente = "UPDATE persona SET nombre=?, apellido=?, telefono=?, direccion=? WHERE DNI = ?";

    // Initialize a statement
    $stmt = mysqli_prepare($conexion, $updateCliente);

    // Assuming DNI is available, replace 'your_dni_value' with the actual DNI
    $dni = $_SESSION['usuario'];

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellidos, $telefono, $direccion, $dni);

    // Execute the statement
    $update = mysqli_stmt_execute($stmt);

    if ($update) {
        echo '
        <script>
            alert("DATOS ACTUALIZADOS!");
            window.location.assign("../client.php"); 
        </script>
    ';
    } else {
        echo '
        <script>
            alert("ERROR EN LA MODIFICACIÓN: ' . mysqli_error($conexion) . '");
            window.location.assign("https://clinicamontalban.com/login.php"); 
        </script>
    ';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo '
    <script>
        alert("ERROR: Invalid request.");
        window.location.assign("https://clinicamontalban.com/login.php"); 
    </script>
';
}

// Close the database connection
mysqli_close($conexion);
?>
