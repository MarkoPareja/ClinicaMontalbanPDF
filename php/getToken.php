<?php
// Verificar si el parámetro 'correo' está presente en la URL
if (isset($_GET['token'])) {
    // Obtener el valor de 'correo' desde la URL
    $token = urldecode($_GET['token']);
} else {
    // Manejar el caso en que el parámetro 'correo' no esté presente en la URL
    echo 'Error: El parámetro "token" no está presente en la URL.';
    exit; // O realizar alguna otra acción apropiada
}
?>