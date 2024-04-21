<?php
// Verificar si el parámetro 'correo' está presente en la URL
if (isset($_GET['correo'])) {
    // Obtener el valor de 'correo' desde la URL
    $correo = urldecode($_GET['correo']);
} else {
    // Manejar el caso en que el parámetro 'correo' no esté presente en la URL
	echo '<script>alert("Error: El parámetro "correo" no está presente en la URL."); window.location.href="../login.php";</script>';
    exit; // O realizar alguna otra acción apropiada
}
?>
