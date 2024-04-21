<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Montalban | Quienes somos</title>
    <link rel="stylesheet" href="assets/css/qs_style.css">
    <link href="https://db.onlinewebfonts.com/c/150037e11f159dca84bc4c04549094b6?family=Averta-Regular" rel="stylesheet"> 
    <link rel="icon" type="image/x-icon" href="assets/img/logo-ico.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="gradient"></div>

    <header class="main-header">

      <nav class="navbar navbar-expand-lg bg-body-tertiary custom-nav" style="background-color: white !important;">

          <a href="index.html">
            <div><img src="assets/img/LOGO-COLOR.png" width="80px" class="imagenlogo" height="80px" alt="LOGOTIPO DE LA EMPRESA"></div>
          </a> 
          <div class="titulo">Clinica</div>
          <div class="titulo2">Montalban</div>

          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">INICIO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="eindex.php">ESPECIALIDADES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="qsindex.php">QUIÉNES SOMOS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contacto.php">CONTACTO</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="flexiniciosesion">
            <div class="rectangulo">

              <?php
                  // Verificar si la sesión está iniciada
                  session_start();
                  if (isset($_SESSION['usuario'])) {
                      // Si está iniciada, mostrar el botón con la función onclick
                      echo '<a class="linksindecoracion" href="client.php"><div style="color: white; font-weight: bold;" class="entraryregistrarse">MI CUENTA</div></a>';
                  } else {
                      // Si no está iniciada, mostrar el enlace normal
                      echo '<a class="linksindecoracion" href="login.php"><div style="color: white; font-weight: bold;" class="entraryregistrarse">PEDIR CITA</div></a>';
                  }
              ?>

            </div>
            </div>
        </nav>
                </header>
        <header class="headeroculto">
    <nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
            <a href="index.php"><div><img src="assets/img/LOGO-COLOR.png" width="55px" class="imagenlogo-pequeño" height="55px" alt="LOGOTIPO DE LA EMPRESA"></div></a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">&nbsp;</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
        <li class="nav-item">
                  <a class="nav-link" href="index.php">INICIO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="eindex.php">ESPECIALIDADES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="qsindex.php">QUIÉNES SOMOS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contacto.php">CONTACTO</a>
                </li> 
            </ul>
          </li>
        </ul>
        <div class="flexiniciosesion-pequeño">
            <div class="rectangulo-pequeño">

              <?php
                  // Verificar si la sesión está iniciada
                  session_start();
                  if (isset($_SESSION['usuario'])) {
                      // Si está iniciada, mostrar el botón con la función onclick
                      echo '<a class="linksindecoracion" href="client.php"><div style="color: white; font-weight: bold;" class="entraryregistrarse">MI CUENTA</div></a>';
                  } else {
                      // Si no está iniciada, mostrar el enlace normal
                      echo '<a class="linksindecoracion" href="login.php"><div style="color: white; font-weight: bold;" class="entraryregistrarse">PEDIR CITA</div></a>';
                  }
              ?>

            </div>
            </div>
      </div>
    </div>
  </div>
</nav>
      </header>
      <br class="vacio"><br class="vacio"><br><br><br><br>
      
      <p class="tituloqs">¿QUIÉNES SOMOS?</p>
      <img src="assets/img/quienes-somos-principal.jpg" alt="Fotografia antiguas sobre la empresa" class="imagenqs">
      
      <div class="flexqs">
        <div class="flexhistoria">
          <p style="font-weight: bolder;">HISTORIA</p>
          <p>Clinica Montalban abrió sus puertas el 10 de abril de 1970, gracias a la congregación religiosa las Hijas de San José, quién tomó la decisión de construir un centro hospitalario en los terrenos adyacentes a su sede de la calle Ganduxer de Barcelona.</p>
          <p>Desde un inicio, la voluntad de la Clínica fue convertirse en una entidad que agrupara todas las especialidades médicas y quirúrgicas, incorporar la última tecnología médico-quirúrgica y con un cuerpo facultativo y equipo de enfermería altamente cualificado, características plenamente vigentes en la actualidad.</p>
          <p>En 1991, 103 de los facultativos vinculados a la Clínica constituyeron la sociedad Clinica Montalban, SA, convirtiéndose ésta en propietaria de la Clínica, siendo un modelo innovador e independiente por el que tanto la propiedad como la gestión de la Clínica estaba en manos de los médicos que trabajaban.</p>
          <p>Dentro de este grupo de médicos accionistas, también se encontraba el Dr. Echevarne. Veinte y cinco años más tarde, en 2016, Grupo Echevarne tomó la iniciativa de convertirse en propietario único del accionariado de la sociedad, manteniendo el excelente cuadro médico.</p>
        </div>
        <div>
          <img class="imagen1" src="assets/img/clinica-antigua.webp" alt="Fotografia antigua de las primeras instalaciones" width="450px" >
        </div>
      </div>

      <footer>
        <div class="columnas">
          <div class="columna1">
            <div class="flexfooter1">
                <a href="index.php"><img src="assets/img/LOGO-COLOR.png" width="52px" height="52px" alt="LOGOTIPO DE LA EMPRESA"></a>  
                <div class="titulo3">Clinica</div>
                <div class="titulo4">Montalban</div>
            </div>
            <p class="textodireccion">
              C/ Sant Mateu, 24-26<br>
              08950 Esplugues del Llobregat,<br>
              Barcelona<br>
              contacto@clinicamontalban.com<br>
            </p>
            <div class="flexfooter2">
                <a href="https://www.instagram.com/clinica.montalban/" class="instagram"><img width="30px" src="assets/img/instagram.png"></a>
                <a href="" class="instagram"><img width="30px" src="assets/img/facebook.png"></a>
                <a href="" class="instagram"><img width="30px" src="assets/img/twitter.png"></a>
            </div>
          </div>
        
  
          <div class="flexfooter3">
            <a class="footertext" href="">Politica de privacidad</a>
            <a class="footertext"  href="">Política de cookies</a>
            <a class="footertext"  href="">Aviso Legal</a>
            <a class="footertext"  href="">Cumplimiento Normativo</a>
            <a class="footertext"  href="">Código ético y de conducta</a>
          </div>
  
  
  
          <div class="flexfooter4">
            <a class="footertext"  href="">Documentación de interés</a>
            <a class="footertext"  href="">FAQS</a>
            <a class="footertext"  href="">Servicios externos vinculados</a>
          </div>
        </div>
        <div class="Copyright">© Copyright 2023. Clínica Montalban S.A.</div>
      </footer>
  
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/js/login_script.js"></script>
</body>
</html>