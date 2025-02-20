<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://localhost/Ekuifarm-Frontend/assets/css/style.css" />
    <link rel="stylesheet" href="http://localhost/Ekuifarm-Frontend/assets/css/darkmode.css" id="dark-mode-stylesheet" disabled />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"
        integrity="sha512-7DgGWBKHddtgZ9Cgu8aGfJXvgcVv4SWSESomRtghob4k4orCBUTSRQ4s5SaC2Rz+OptMqNk0aHHsaUBk6fzIXw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="icon" href="./assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-chubby/css/uicons-thin-chubby.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-curvy/css/uicons-thin-curvy.css'>
</head>

<body>
    <header>
        <div class="sidebar" id="sidebar">
            <div class="logo-container d-flex align-items-center justify-content-center">
                <div class="logoFarm">
                    <button class="navbar-toggler" type="button" id="toggleButton"><img src="http://localhost/Ekuifarm-Frontend/assets/img/logo.png" alt="Logo"></button>
                </div>
                <div class="texto ms-2">
                    <h4 class="mb-0">EkuiFarm</h4>
                    <p class="text-secondary" style="font-size: 13px; font-weight: 550">Gestión de Farmacia</p>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item1" id="itemProducts">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/panelAdmin.php">
                        <div class="icon-container">
                            <i class="fi fi-rs-apps"></i>
                        </div>
                        <div class="text-container">Dashboard</div>
                    </a>
                </li>
                <h6 class="sectionNames ms-4 mb-3 mt-3">MANTENIMIENTO</h6>
                <li class="nav-item1" id="itemProducts">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/mantenimiento/productos/productos.php">
                        <div class="icon-container">
                            <i class="fi fi-tr-boxes"></i>
                        </div>
                        <div class="text-container">Productos</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemClients">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/mantenimiento/clientes/clientes.php">
                        <div class="icon-container">
                        <i class="fi fi-rr-user"></i>
                        </div>
                        <div class="text-container">Clientes</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemEmployees">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/mantenimiento/empleados/empleados.php">
                        <div class="icon-container">
                            <i class="fi fi-tr-users-alt"></i>
                        </div>
                        <div class="text-container">Empleados</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemRoles">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/roles/roles.php">
                        <div class="icon-container">
                            <i class="fi fi-ts-key"></i>
                        </div>
                        <div class="text-container">Roles</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemProveedores">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/proveedores/proveedores.php">
                        <div class="icon-container">
                            <i class="fi fi-tc-truck-side"></i>
                        </div>
                        <div class="text-container">Proveedores</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemCategorias">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/mantenimiento/categorias/categorias.php">
                        <div class="icon-container">
                            <i class="fi fi-tr-tags"></i>
                        </div>
                        <div class="text-container">Categorías</div>
                    </a>
                </li>
                <h6 class="sectionNames ms-4 mb-3 mt-3">TIENDA</h6>
                <li class="nav-item1" id="itemVentas">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/ventas/ventas.php">
                        <div class="icon-container">
                            <i class="fi fi-ts-seller-store"></i>
                        </div>
                        <div class="text-container">Ventas</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemFacturacion">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/facturacion/facturacion.php">
                        <div class="icon-container">
                            <i class="fi fi-tr-print"></i>
                        </div>
                        <div class="text-container">Facturación</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemReportes">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/reportes/reportes.php">
                        <div class="icon-container">
                            <i class="fi fi-tr-search-alt"></i>
                        </div>
                        <div class="text-container">Reportes</div>
                    </a>
                </li>
                <li class="nav-item1" id="itemEstadoDeCuenta">
                    <a class="nav-link1 d-flex align-items-center" href="http://localhost/Ekuifarm-Frontend/view/estadoDeCuenta/estadoDeCuenta.php">
                        <div class="icon-container">
                            <i class="fi fi-ts-shopping-basket"></i>
                        </div>
                        <div class="text-container">Estado de Cuenta</div>
                    </a>
                </li>
            </ul>
            <div class="ms-4">
                <h6 class="sectionNames mb-4">CONFIGURACIÓN</h6>
                <div class="form-check form-switch">
                    <input type="checkbox" id="darkModeToggle" class="form-check-input" />
                    <label for="darkModeToggle" class="form-check-label">Modo Oscuro</label>
                </div>
            </div>
            <div class="nav-item1 ms-1" style="margin-top: auto;">
                <a class="nav-link1" href="http://localhost/Ekuifarm-Frontend/logout.php">
                    <div class="icon-container">
                        <i class="fa-solid fa-sign-out-alt"></i>
                    </div>
                    <div class="text-container">Cerrar Sesión</div>
                </a>
            </div>
        </div>
    </header>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="http://localhost/Ekuifarm-Frontend/assets/js/script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="http://localhost/Ekuifarm-Frontend/assets/js/productos/productos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>