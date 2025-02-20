
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <title>EkuiFarm - Gestión de Pacientes y Tratamientos</title>
  <!-- Meta Tags Requeridos -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


  <!-- Bootstrap CSS v5.3.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/css/principal.css" />

  <!-- Google Fonts & FontAwesome -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body>
  <!-- Header -->
  <header>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img class="img-fluid me-2" src="./assets/img/logo.png" alt="Logo de EkuiFarm" width="55" height="55" />
          <span>EkuiFarm</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse bg-white m-0 p-0" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#inicio">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#acerca">Acerca de Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#proveedores">Proveedores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contacto">Contacto</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link bg-primary text-white rounded px-3" href="./login.php">Iniciar Sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main id="inicio" class="hero-section d-flex flex-column justify-content-center align-items-center text-center">
    <div class="container">
      <h1 class="text-white display-4">EkuiFarm</h1>
      <p class="text-white lead">
        Gestiona la información de pacientes y tratamientos de manera
        eficiente.
      </p>
      <a href="#contacto" class="btn btn-warning btn-lg">Contactanos</a>
    </div>
  </main>

  <!-- Acerca de Nosotros -->
  <section id="acerca" class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="./assets/img/acerca.jpg" alt="Acerca de EkuiFarm" class="img-fluid rounded" />
        </div>
        <div class="col-md-6">
          <h2>Acerca de Nosotros</h2>
          <p>
            En EkuiFarm, nos dedicamos a proporcionar soluciones integrales
            para la gestión de pacientes y tratamientos en el sector
            farmacéutico. Nuestra misión es optimizar los procesos y mejorar
            la eficiencia mediante herramientas tecnológicas avanzadas.
          </p>
          <p>
            Con años de experiencia en el mercado, hemos consolidado alianzas
            estratégicas con proveedores líderes para garantizar la calidad y
            disponibilidad de los productos que ofrecemos.
          </p>
          <a href="#contacto" class="btn btn-outline-primary">Contáctanos</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Servicios -->
  <section id="servicios" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-5">Nuestros Servicios</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <div class="card-body">
              <i class="fas fa-shopping-cart fa-3x text-primary mb-3"></i>
              <h5 class="card-title">Gestión de Ventas</h5>
              <p class="card-text">
                Administra y realiza un seguimiento de todas las transacciones
                de ventas de manera eficiente y segura.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <div class="card-body">
              <i class="fas fa-boxes fa-3x text-primary mb-3"></i>
              <h5 class="card-title">Control de Inventario</h5>
              <p class="card-text">
                Mantén un control preciso de tus existencias para evitar
                faltantes y optimizar el almacenamiento.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <div class="card-body">
              <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
              <h5 class="card-title">Reportes y Análisis</h5>
              <p class="card-text">
                Genera reportes detallados para analizar el rendimiento y
                tomar decisiones informadas.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Proveedores -->
  <section id="proveedores" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Nuestros Proveedores</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <img src="./assets/img/proveedor1.jpg" class="card-img-top p-4" alt="Proveedor 1"
              style="height: 200px; object-fit: contain" />
            <div class="card-body">
              <h5 class="card-title">Proveedor A</h5>
              <p class="card-text">
                Líder en suministros farmacéuticos de alta calidad,
                garantizando la disponibilidad de productos esenciales.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <img src="./assets/img/proveedor2.jpg" class="card-img-top p-4" alt="Proveedor 2"
              style="height: 200px; object-fit: contain" />
            <div class="card-body">
              <h5 class="card-title">Proveedor B</h5>
              <p class="card-text">
                Especialistas en tecnologías de gestión de inventarios,
                proporcionando soluciones innovadoras.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <img src="./assets/img/proveedor3.jpg" class="card-img-top p-4" alt="Proveedor 3"
              style="height: 200px; object-fit: contain" />
            <div class="card-body">
              <h5 class="card-title">Proveedor C</h5>
              <p class="card-text">
                Distribuidores confiables de medicamentos y productos
                farmacéuticos, asegurando calidad y eficiencia.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonios -->
  <section id="testimonios" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Testimonios</h2>
      <div id="testimoniosCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <img src="./assets/img/testimonial1.jpg" class="rounded-circle mb-4" alt="Cliente 1" width="100"
                  height="100" />
                <h5>María López</h5>
                <p class="text-muted">
                  "EkuiFarm ha transformado la manera en que gestionamos
                  nuestros tratamientos. ¡Altamente recomendado!"
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <img src="./assets/img/testimonial2.jpg" class="rounded-circle mb-4" alt="Cliente 2" width="100"
                  height="100" />
                <h5>Juan Pérez</h5>
                <p class="text-muted">
                  "La interfaz es muy amigable y el soporte al cliente es
                  excepcional. Nos ha ayudado a ser más eficientes."
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <img src="./assets/img/testimonial3.jpg" class="rounded-circle mb-4" alt="Cliente 3" width="100"
                  height="100" />
                <h5>Luisa Gómez</h5>
                <p class="text-muted">
                  "Gracias a EkuiFarm, ahora puedo manejar toda la información
                  de mis pacientes de forma centralizada y segura."
                </p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-5">Contáctanos</h2>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" placeholder="Tu nombre" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="email" placeholder="tu@correo.com" required />
            </div>
            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea class="form-control" id="mensaje" rows="5" placeholder="Tu mensaje" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
      <!-- Mapa de Google Maps -->
      <div class="row mt-5">
        <div class="col-md-12">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0196723722554!2d-122.41941508468198!3d37.77492927975913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064f6bf56c5%3A0xa7f7c0b0e8b2c6e2!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1600000000000!5m2!1sen!2sus"
            width="100%" height="450" frameborder="0" style="border: 0" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center p-4">
    <div class="container">
      <p>&copy; 2024 EkuiFarm. Todos los derechos reservados.</p>
      <div class="d-flex justify-content-center mt-3">
        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
  integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+eXRYi70nFhBV1I7q0q5K4T5qvZo+"
    crossorigin="anonymous"></script>

  <!-- Custom Script para Navbar Sticky -->
  <script>
    window.addEventListener("DOMContentLoaded", (event) => {
      // Seleccionar la navbar
      const navbar = document.getElementById("navbar");

      // Obtener la posición offset de la navbar
      const sticky = navbar.offsetTop;

      // Función para añadir o quitar la clase 'sticky'
      function handleScroll() {
        if (window.pageYOffset >= sticky) {
          navbar.classList.add("sticky");
        } else {
          navbar.classList.remove("sticky");
        }
      }

      // Añadir el evento de scroll
      window.addEventListener("scroll", handleScroll);
    });
  </script>
</body>

</html>