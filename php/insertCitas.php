<?php

    /*  Basicamente esta funcion recoge todo lo del formulario de calendario
        y hace un insert a la base de datos con una cita nueva. */
    include 'conexion_be.php';
    
    session_start();
    
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../login.php");
        exit;
    }
    
    $idTrabajador = $_POST['idTrabajador'];
    $idCliente = $_POST['idCliente'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $descripcion = $_POST['descripcion'];
    $DNI_USER = $_SESSION['usuario'];

    // Utilizar consultas preparadas para evitar problemas de SQL injection
    $query = "INSERT INTO cita (idTrabajador, idCliente, fecha, hora, descripcion) VALUES (?, (SELECT idCliente FROM cliente WHERE DNI=?), ?, ?, ?)";

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "issss", $idTrabajador, $DNI_USER, $fecha, $hora, $descripcion);

    // Ejecutar la consulta
    $result = mysqli_stmt_execute($stmt);

    $response = array();

    if($result){
        $response['success'] = true;
        $response['message'] = 'Cita insertada con éxito';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al insertar cita: ' . mysqli_error($conexion);
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);

    header('Content-Type: application/json');
    echo json_encode($response);
?>