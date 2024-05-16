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
            echo "<script>
                localStorage.setItem('token', 'La contraseña se ha actualizado correctamente!');
                setTimeout(function() {
                    window.location.href = '../index.php';
                }, 500); // 500 milisegundos de retraso
              </script>";
        } else {
            echo "<script>
                localStorage.setItem('token', 'Error al actualizar la contraseña: ".mysqli_error($conexion) . "');
                setTimeout(function() {
                    window.location.href = '../index.php';
                }, 500); // 500 milisegundos de retraso
              </script>";
            
        }
    } else {
        echo 'El token no coincide';
    }
} else {
    echo 'No se encontró un usuario con el token especificado.';

    echo $token;
}

?>
