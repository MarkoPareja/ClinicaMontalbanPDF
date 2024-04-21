<?php

//include 'genToken.php';


$token=$_GET['token'];


// Asegúrate de que $token no esté vacío
if (!empty($token)) {

    $verifyTokenQuery = "SELECT correo, reset_token_expires_at FROM persona WHERE reset_token = '$token'";
    $result = mysqli_query($conexion, $verifyTokenQuery);

    // Manejar errores de SQL
    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    if (($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $correo = $row['correo'];
        $expiresAt = strtotime($row['reset_token_expires_at']);


        if (time() < $expiresAt) {

            echo '<script>window.location("../resetContra.php")</script>';

        } else {
            // Token expirado, muestra un mensaje o redirige a la página de solicitud de restablecimiento
            echo 'El enlace ha expirado. Por favor, solicite un nuevo restablecimiento de contraseña.';
        }
    } else {
        // Token no válido
        echo 'Token inválido';
    }
} else {
    echo 'El token está vacío.';
}
?>

