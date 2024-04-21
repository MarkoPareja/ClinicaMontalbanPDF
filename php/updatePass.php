<?php

include "conexion_be.php";
$token = $_POST['token'];

$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$selectDniQuery = "SELECT dni, reset_token FROM persona WHERE reset_token = '$token'";
$resultDni = mysqli_query($conexion, $selectDniQuery);

if ($resultDni && mysqli_num_rows($resultDni) > 0) {
    $row = mysqli_fetch_assoc($resultDni);
    $dniUsuario = $row['dni'];
    $tokenFromDB = $row['reset_token'];

    if ($tokenFromDB == $token) {
        $updateContra = "UPDATE cliente SET contrasena = '$contrasena' WHERE dni = '$dniUsuario'";
        $resultUpdate = mysqli_query($conexion, $updateContra);

        if ($resultUpdate) {
            echo '<script>alert("La contraseña se ha actualizado correctamente!"); window.location.href="../index.php";</script>';
        } else {
            echo 'Error al actualizar la contraseña: ' . mysqli_error($conexion);
        }
    } else {
        echo 'El token no coincide';
    }
} else {
    echo 'No se encontró un usuario con el token especificado.';

    echo $token;
}

?>
