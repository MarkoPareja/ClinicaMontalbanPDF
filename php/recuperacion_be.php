<?php

require '../vendor/autoload.php';
include 'conexion_be.php';


$formulario = $_POST['formulario'];
$codigo = rand(1, 9999);
$correo = $_POST['correo_recovery'];


if ($formulario === 'recuperacion') {
    
    $consulta_correo = "SELECT * FROM persona WHERE correo = '$correo'";
    
    $resultado_correo = mysqli_query($conexion, $consulta_correo);

    if (mysqli_num_rows($resultado_correo) > 0) {

        include 'correoHelper.php';

        if (enviarCorreo($correo, 'Codigo de verificacion',$cuerpo, $codigo, $enlace)) {


            header("Location: ../codigoContra.php?correo=" . urlencode($correo));
            
            $updateCode = "UPDATE persona SET codigo = '$codigo' WHERE correo = '$correo'";
            
            $resultado_correo = mysqli_query($conexion, $updateCode);


        }  else {
        
	    echo '<script>alert("El correo introducido no existe, revisa los datos"); window.location.href="../login.php";</script>';
	}
    } else {
	
	echo '<script>alert("Error al enviar el correo"); window.location.href="../login.php";</script>';

    }

} elseif ($formulario === 'codigo') {

    // Código para comprobar el código de verificación

    $correo = $_POST['correo_recovery'];

    $compareCodeQuery = "SELECT codigo FROM persona WHERE correo = '$correo'";

    $resultCompareCode = mysqli_query($conexion, $compareCodeQuery);


if (mysqli_num_rows($resultCompareCode) > 0) {



    $row = mysqli_fetch_assoc($resultCompareCode);

    $codigoAlmacenado = $row['codigo'];
    
    if (isset($_POST['codigoIngresado'])) {


        $codigoIngresado = $_POST['codigoIngresado'];

        if ($codigoAlmacenado == $codigoIngresado) {


            header("Location: genToken.php?correo=" . urlencode($correo));


        }else{

    		// No hay filas en el resultado o error en la consulta
    		echo '<script>alert("Error al verificar el código de comparación."); window.location.href="../login.php";</script>';

            }

        }
    }

}




?>





