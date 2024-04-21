<?php

if(session_start()){

    include 'conexion_be.php';

    $DNI = $_POST['dni'];
    $contrasena = $_POST['contrasena'];

    // Escapar las variables antes de usarlas en una consulta SQL para prevenir SQL Injection
    $DNI = mysqli_real_escape_string($conexion, $DNI);

    // Hashear la contraseña antes de compararla con la base de datos
    $contrasena = hash('sha512', $contrasena);

    // Utiliza una consulta preparada para prevenir SQL Injection
    $validar_login = mysqli_prepare($conexion, "SELECT DNI, contrasena FROM cliente WHERE DNI=? and contrasena=?");
    mysqli_stmt_bind_param($validar_login, "ss", $DNI, $contrasena);
    mysqli_stmt_execute($validar_login);
    mysqli_stmt_store_result($validar_login);

if (mysqli_stmt_num_rows($validar_login) > 0) {
    $_SESSION['usuario'] = $DNI;

    header("Location: ../client.php");
    exit;
} else {
    // Redirigir a la página de login con un parámetro en la URL
    header("Location: ../login.php?error=1");
    exit;
}
mysqli_stmt_close($validar_login);

}
?>
