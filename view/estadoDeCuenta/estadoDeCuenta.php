<!doctype htm
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="http://localhost:8088/EkuiFarm-Frontend/assets/css/productos.css">
    <link rel="stylesheet" href="http://localhost:8088/EkuiFarm-Frontend/assets/css/darkmode.css"
        id="dark-mode-stylesheet" disabled>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body class="bodyProduct">
    <div class="my-4 productos">
        <!-- Título principal -->l>
        <h2 class="mb-4">Modulo de Estado de Cuenta</h2>

        <div class="d-flex flex-column">
            <!-- Columna izquierda: Acciones y Registro de Producto -->
            <div class="col-md-12">
            <h4 class="productSection">Filtro de Busqueda</h4>
                <section class="registrar-producto p-4 d-flex justify-content-center flex-column flex-lg-row">
                    <form class="mt-4 col-6">
                        <div class="mb-3 d-flex gap-3 align-items-center">
                            <label for="nombre" class="form-label w-50">RANGO DE FECHAS:</label>
                            <input type="date" class="input w-50" id="nombre">
                        </div>
                        <div class="mb-3 d-flex gap-3 align-items-center">
                            <label for="descripcion" class="form-label w-50">.......</label>
                            <input type="date" class="input w-50" id="nombre">
                        </div>
                        <div class="mb-3 d-flex gap-3 align-items-center">
                            <label for="descripcion" class="form-label w-50">DNI O RUC</label>
                            <input type="text" class="input w-50" id="nombre">
                        </div>
                        <div class="mb-3 d-flex gap-3 align-items-center">
                            <label for="descripcion" class="form-label w-50">PRODUCTO</label>
                            <input type="text" class="input w-50" id="nombre">
                        </div>
                    </form>
                    <div class="filterAction flex-column d-flex align-items-center justify-content-center w-100 gap-3">
                    <button class="btn btn-dark" style="width: 150px">Buscar</button>
                    <button class="btn btn-secondary" style="width: 150px">Limpiar Filtro</button>
                    <button class="btn btn-primary" style="width: 150px">Imprimir</button>
                    </div>
                </section>
            </div>

            <!-- Columna derecha: Criterio de Búsqueda y Lista de Productos -->
            <div class="col-md-12 mt-4">
                <section class="lista-productos p-4">
                    <h4 class="mb-3 productSection">LISTA DE PRODUCTOS</h4>
                    <div class="mb-3 p-2 d-flex rounded justify-content-center search">
                        <div class="w-50 d-flex rounded p-1 buscarProductos" style="border: 1px solid rgba(0,0,0,0.1);">
                            <i class="fa-solid fa-magnifying-glass mt-1 me-2 ms-2"></i>
                            <input type="search" class="w-100" placeholder="Search" style="border: none;">
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="" checked />
                        <label class="form-check-label" for="" style="font-weight: 600; font-size: 14px">Selección
                            Múltiple</label>
                    </div>
                    <div class="container mb-2">
                        <div class="table-wrapper">
                            <table class="table table-hover" style="cursor: pointer;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCION</th>
                                        <th>CATEGORÍA</th>
                                        <th>PRECIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Paracetamol</td>
                                        <td>Alivia Dolor</td>
                                        <td>Analgésicos</td>
                                        <td>S/3.50</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Ibuprofeno</td>
                                        <td>Reduce Fiebre</td>
                                        <td>Analgésicos</td>
                                        <td>S/4.00</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Aspirina</td>
                                        <td>Previene Coágulos</td>
                                        <td>Analgésicos</td>
                                        <td>S/2.80</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Amoxicilina</td>
                                        <td>Antibiótico</td>
                                        <td>Antibióticos</td>
                                        <td>S/5.00</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Metformina</td>
                                        <td>Controla Diabetes</td>
                                        <td>Antidiabéticos</td>
                                        <td>S/6.50</td>
                                    </tr>
                                    <!-- Agrega más filas si es necesario -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </section>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>