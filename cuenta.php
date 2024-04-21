<!DOCTYPE html>
<html lang="es">

<?php
session_start();
include 'php/conexion_be.php';
include 'php/getDatosCuenta.php';

// Verificar si hay una sesión de usuario iniciada
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Montalban</title>
    <link rel="stylesheet" href="/assets/css/cuenta_style.css">
    <link href="https://db.onlinewebfonts.com/c/150037e11f159dca84bc4c04549094b6?family=Averta-Regular" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/logo-ico.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <header>
        <div id="espacio-blanco" style="width: 100px;">
            &nbsp;
        </div>
        <div class="logo-clinica">
            <a href="index.php">
                <div style="margin-top: 10px; margin-left: 15px;"><img src="/assets/img/LOGO-COLOR.png" width="80px"
                        height="80px" alt="LOGOTIPO DE LA EMPRESA"></div>
            </a>
            <div class="titulo">Clinica</div>
            <div class="titulo2">Montalban</div>
        </div>
        <div class="btn-group">
            <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bienvenido, <?php echo $nombre ?>!
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="client.php">Servicios</a></li>
                <li><a class="dropdown-item" href="cuenta.php">Modificar Cuenta</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="php/cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </header>
    <section class="title-top">
        <h1>Modifica los datos de tu cuenta</h1>
    </section>
    <form action="php/cuenta_be.php" method="POST" class="form">
        <div class="form-row">
            <div class="form-group col-md-6 nombre">
                <label for="inputName4">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="inputName4" placeholder="Nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
            </div>
            <div class="form-group col-md-6 campo">
                <label for="inputSurname4">Apellidos</label>
                <input type="text" class="form-control" name="apellido" id="inputSurname4" placeholder="Apellido" value="<?php echo isset($apellido) ? $apellido : ''; ?>">
            </div>
            <div class="form-group col-md-6 campo">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni" placeholder="00000000A" value="<?php echo isset($dni) ? $dni : ''; ?>" disabled>
            </div>
            <div class="form-group col-md-6 campo">
                <label for="tsi">TSI</label>
                <input type="text" class="form-control" name="tsi" id="tsi" placeholder="TASA1030101002" value="<?php echo isset($tsi) ? $tsi : ''; ?>" disabled>
            </div>
            <div class="form-group campo">
                <label for="inputAddress">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="inputAddress" placeholder="Dirección" value="<?php echo isset($direccion) ? $direccion : ''; ?>">
                										
            </div>
            <div class="form-group col-md-6 campo">
                <label for="inputPhone4">Telefono</label>
                <input type="tel" class="form-control" name="telefono" id="inputPhone4" placeholder="Telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>">
            </div>
        </div>
        </div>
        <div class="form-group campo">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Verificame
            </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Modificar la cuenta</button>
    </form>

    <script src="assets/js/confirmarSubmit.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
