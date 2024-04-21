<?php


$conexion = mysqli_connect("mysql-adminmontalban.alwaysdata.net","329292_admin","adminmontalban!","adminmontalban_clinica");





if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>