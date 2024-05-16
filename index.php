<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Montalban</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://db.onlinewebfonts.com/c/150037e11f159dca84bc4c04549094b6?family=Averta-Regular" rel="stylesheet"> 
    <link rel="icon" type="image/x-icon" href="assets/img/logo-ico.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="gradient"></div>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
      <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>
  <div id="container-alerta" class="hide">
    <div class="alert alert-dismissible fade show alert-success d-flex align-items-center alerta" role="alert">
    <svg class="bi flex-shrink-0 me-2 alerta-boton" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div id="responsetoken"></div>
    <button type="button" class="btn-close boton-cerrar" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>

    <header class="main-header">

      <nav class="navbar navbar-expand-lg bg-body-tertiary custom-nav" style="background-color: white !important;">

          <a href="index.php">
            <div><img src="assets/img/LOGO-COLOR.png" width="80px" class="imagenlogo" height="80px" alt="Logotipo de Clinica Montalban"></div>
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
                  <a class="nav-link active" aria-current="page" href="index.php">INICIO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="eindex.php">ESPECIALIDADES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="qsindex.php">QUIÉNES SOMOS</a>
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
            <a href="index.php"><div><img src="assets/img/LOGO-COLOR.png" width="55px" class="imagenlogo-pequeño" height="55px" alt="Logotipo de Clinica Montalban"></div></a> 
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
                  <a class="nav-link active" aria-current="page" href="index.php">INICIO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="eindex.php">ESPECIALIDADES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="qsindex.php">QUIÉNES SOMOS</a>
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


                  
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" style="max-height: 650px;">
            <div class="carousel-item active">
                <img src="assets/img/carousel1.jpg" class="d-block w-100 img-fluid" alt="Preocupate solo de tu salud">
            </div>
            <div class="carousel-item">
                <img src="assets/img/carousel2.jpg" class="d-block w-100 img-fluid" alt="Hacemos de tu salud nuestra prioridad">
            </div>
            <div class="carousel-item">
                <img src="assets/img/carousel3.jpg" class="d-block w-100 img-fluid" alt="Habitaciones donde te sentiras como en casa">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      
    </div>
    <br class="vacio">
    <br class="vacio">
    <br class="vacio">
    <br class="vacio">
    <p class="tituloindex">INICIO</p>
    <div class="flex-pagina">
      <div class="flex1">
        <div class="texto1">
          <p class="p1-1">Quienes somos</p>
          <p class="p1-2">El equipo de Clinica Montalban trabaja con gran profesionalidad para ofrecer y garantizar una asistencia de primera calidad.</p>
          <a href="qsindex.php" style="border-radius: 10px; box-shadow: 0  2px 8px 5px rgba(0, 0, 0, 0.15);" type="button" class="btn btn-light sm-01">Saber más</a>
        </div>
        <img class="img1" style="border-radius: 20px; box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.15);" width="500px" src="assets/img/img1.jpg" alt="Medicos, Enfermeros trabajando en una sala quirurgica, operando">
      </div>

      <div class="flex1 flex2">
        <img class="img2" style="border-radius: 20px; box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.15);" width="500px" src="assets/img/especialistas.jpg" alt="Equipo de enfermeros y medicos especialistas, en el hospital, clinica, medico">
        <div class="texto1">
          <p style="font-size: 40px; font-weight: bolder;">Especialistas</p>
          <p style="width: 600px; font-size: 30px;">El equipo de Clinica Montalban consta con los mejores profesionales para cada una de las especialidades en la sanidad.</p>
          <a href="eindex.php" style="border-radius: 10px; box-shadow: 0  2px 8px 5px rgba(0, 0, 0, 0.15);" type="button" class="btn btn-light ">Saber más</a>
        </div>
      </div>

      <div class="flex1 flexoculto">
        <div class="texto1">
          <p class="p1-1">Especialistas</p>
          <p class="p1-2">El equipo de Clinica Montalban consta con los mejores profesionales para cada una de las especialidades en la sanidad.</p>
          <a href="eindex.php" style="border-radius: 10px; box-shadow: 0  2px 8px 5px rgba(0, 0, 0, 0.15);" type="button" class="btn btn-light sm-01">Saber más</a>
        </div>
        <img class="img2" style="border-radius: 20px; box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.15);" width="500px" src="assets/img/especialistas.jpg" alt="Equipo de enfermeros y medicos especialistas, en el hospital, clinica, medico">
      </div>
    </div>
                
    <div class="flexcartas">
      <div class="card" style="width: 22rem;">
        <img src="assets/img/icono_curar-1.png" width="50px" alt="Logitopo Medico">
        <div class="card-body">
          <h5 class="card-title">Curar</h5>
          <p class="card-text">Nuestro equipo de profesionales combina talento, vocación, pasión y una amplia trayectoria para brindarte una atención médica eficiente y personalizada.</p>
        </div>
        <img src="assets/img/tarjeta1.jpg" class="card-img-top img-top" alt="Chica tocandose el corazon sanando heridas">    
      </div>
      <div class="card" style="width: 22rem;">
        <img src="assets/img/Icono_cuidar-1.png" width="55px" alt="Logotipo dandose la mano">
        <div class="card-body">
          <h5 class="card-title">Cuidar</h5>
          <p class="card-text">Nos comprometemos a ofrecerte una alta capacidad médica con un trato humano y cercano para crear un entorno de confianza entre profesionales y pacientes.</p>
        </div>
        <img src="assets/img/tarjeta2.jpg" class="card-img-top img-top" alt="Equipo de Clinica Montalban ayudando a una persona mayor a levantarse">
      </div>
      <div class="card" style="width: 22rem;">
        <img src="assets/img/iconoservicios-1.png" width="40px" alt="Logotipo lista servicios">
        <div class="card-body">
          <h5 class="card-title">Mi Servicios</h5>
          <p class="card-text">Queremos que tu paso por Clinica Montalban sea una experiencia agradable para ti. Por eso, ponemos a t u disposición una serie de servicios adicionales con la finalidad de mejorar tu satisfacción y amenizar tu estancia.</p>
        </div>
        <img src="assets/img/tarjeta3.jpg" style="background-size: cover;" class="card-img-top img-top" alt="Equipo tecnoligico que posee Clinica Montalban">
      </div>
    </div>
    <footer>
      <div class="columnas">
        <div class="columna1">
          <div class="flexfooter1">
              <a href="index.php"><img src="assets/img/LOGO-COLOR.png" width="52px" height="52px" alt="Logotipo de Clinica Montalban"></a>  
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
              <a href="https://www.instagram.com/clinica.montalban/" class="instagram"><img width="30px" src="assets/img/instagram.png" alt="Instagram Clinica Montalban"></a>
              <a href="" class="instagram"><img width="30px" src="assets/img/facebook.png" alt="Facebook Clinica Montalban"></a>
              <a href="" class="instagram"><img width="30px" src="assets/img/twitter.png" alt="Twitter Clinica Montalban"></a>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("container-alerta").classList.add("hide");
            // Obtener el mensaje de error de localStorage
            var token = localStorage.getItem('token');
            if (token) {
                // Mostrar el token en el elemento con id 'errorCorreo'
                document.getElementById('responsetoken').innerText = token;
                // Limpiar el token de localStorage para futuras visitas
                localStorage.removeItem('token');
                console.log("Si recibe token");
                activarResponse();
            }
            else{
              console.log("No recibe token");
              desactivarResponse();
            }
        });

        function activarResponse(){
          let alert = document.getElementById("container-alerta");
            alert.classList.remove("hide");
            alert.classList.add("hide-recovery");
            alert.style.visibility = "visible"; // Asegura que el elemento esté visible
        }

        function desactivarResponse(){
          document.getElementById("container-alerta").classList.add("hide");
        }
    </script>

</body>
</html>
