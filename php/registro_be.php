<?php
include 'conexion_be.php';
/*Creacion de las variables con el metodo POST para 
recoger los valores del registro y subirlos a 
la base de datos.
*/
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$tsi = $_POST['tsi'];
$nacimiento = $_POST['nacimiento'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Encriptacion
$contrasena = hash('sha512', $contrasena);



// Verificacion si el DNI o el correo ya existen en la base de datos


$consulta_dni = "SELECT * FROM persona WHERE DNI = '$dni'";
$consulta_correo = "SELECT * FROM persona WHERE correo = '$correo'";

$resultado_dni = mysqli_query($conexion, $consulta_dni);
$resultado_correo = mysqli_query($conexion, $consulta_correo);

if (mysqli_num_rows($resultado_dni) > 0) {
  
    echo '
        <script>
            alert("El DNI ya está registrado. Por favor, utiliza otro DNI.");
            window.location.assign("https://clinicamontalban.com/login.php"); 
        </script>
    ';
} elseif (mysqli_num_rows($resultado_correo) > 0) {

    echo '
        <script>
            alert("El correo ya está registrado. Por favor, utiliza otro correo.");
            window.location.assign("https://clinicamontalban.com/login.php"); 
        </script>
    ';
} else {

    $query = "INSERT INTO persona (DNI, nombre, apellido, correo, telefono, direccion)
    VALUES ('$dni', '$nombre', '$apellidos', '$correo', '$telefono', '$direccion')";

    $query2 = "INSERT INTO cliente (DNI, contrasena, TSI)
    VALUES ('$dni', '$contrasena', '$tsi')";

    $enviar = mysqli_query($conexion, $query);
    $enviar2 = mysqli_query($conexion, $query2);

    if ($enviar && $enviar2) {
        session_start();
        echo '
            <script>
                alert("El registro se ha completado de forma exitosa");
            </script>
            
        ';
        
        if(!isset($_SESSION['DNI'])){
            header("Location: ../client.php");
            exit;
        }
    } else {
        echo '
            <script>
                alert("No se ha podido completar el registro");
                
            </script>
        ';
    }
}

mysqli_close($conexion);
?>
