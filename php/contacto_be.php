<?php

require '../vendor/autoload.php';
include 'conexion_be.php';
include 'correoHelper.php';

$cuerpo = $_POST['duda'];
$correo = $_POST['correo'];
$asunto = 'INCIDENCIA';

$cuerpo = "\n\nUsuario: " . $correo . "\t\nMotivo: " . $cuerpo;

enviarCorreo($correo, $asunto, $cuerpo , $codigo, $enlace);

header("Location: ../index.php");



?>