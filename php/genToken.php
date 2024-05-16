<?php

require '../vendor/autoload.php';
include "conexion_be.php";
include "getCorreo.php";
include "correoHelper.php";

$token = bin2hex(random_bytes(32));

$currentTime = new DateTime();
$expiryTime = $currentTime->add(new DateInterval('PT2H'))->format('Y-m-d H:i:s');

$updateTokenQuery = "UPDATE persona SET reset_token = '$token', reset_token_expires_at = '$expiryTime' WHERE correo = '$correo'";
mysqli_query($conexion, $updateTokenQuery);  

$resetLink = "https://clinicamontalban.com/resetContra.php?token=$token";

$asunto = 'Enlace de recuperacion';

$enlace= $resetLink;

if (enviarCorreo($correo, $asunto ,$cuerpo ,$codigo, $enlace)) {
	
     echo "<script>
                localStorage.setItem('token', 'Completado con exito! Verifica el correo y dale al link.');
                setTimeout(function() {
                    window.location.href = '../index.php';
                }, 500); // 500 milisegundos de retraso
              </script>";
	//echo '<script>alert("Completado con exito! Verifica el correo y dale al link."); window.location.href="../index.php";</script>';

} else {
     echo "<script>
                localStorage.setItem('token', 'Error al enviar el correo.');
                setTimeout(function() {
                    window.location.href = '../index.php';
                }, 500); // 500 milisegundos de retraso
              </script>";
     //echo '<script>alert("Error al enviar el correo."); window.location.href="../index.php";</script>';

}

?>
