<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');
?>

<!doctype html>
<html lang="en">

<head>

    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/productos.css">
    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/darkmode.css" id="dark-mode-stylesheet" disabled>

</head>

<main class="content content-area">
    <div class="my-4 productos">
        <!-- Título principal -->
        <h2 class="mb-4">Modulo de Proveedores</h2>

        <div class="row">
            <!-- Columna izquierda: Acciones y Registro de Producto -->
            <div class="col-md-5">
                <section class="gestion-productos mb-4 p-4">
                    <h4 class="mb-4 productSection">ACCIONES</h4>
                    <!-- Contenedor con separación uniforme -->
                    <div class="d-grid gap-2 botones2">
                        <!-- Botones en una sola fila con espacios entre ellos -->
                        <div class="d-flex flex-wrap justify-content-between gap-2">
                            <button class="btn btn-primary flex-grow-1 me-1">Añadir</button>
                            <button class="btn btn-danger flex-grow-1 mx-1">Eliminar</button>
                            <button class="btn btn-success flex-grow-1 mx-1">Editar</button>
                            <button class="btn btn-secondary flex-grow-1 ms-1">Limpiar</button>
                        </div>
                        <!-- Botones Reporte y Actualizar Filtros en otra fila -->
                        <div class="d-flex justify-content-between mt-2">
                            <button class="btn btn-warning flex-grow-1 me-2 text-white">Reporte</button>
                            <button class="btn flex-grow-1 ms-2 text-white"
                                style="background-color:rgb(123, 83, 161)">Actualizar Filtros</button>
                        </div>
                    </div>
                </section>


                <section class="registrar-producto p-4">
                    <h4 class="productSection">REGISTRAR PROVEEDORES</h4>
                    <form class="d-block mt-4">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">NOMBRE:</label>
                            <input type="text" class="input" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">APELLIDO:</label>
                            <input type="text" class="input" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">TELEFONO:</label>
                            <input type="text" class="input" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">EMAIL:</label>
                            <input type="text" class="input" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">RUC:</label>
                            <input type="text" class="input" id="nombre">
                        </div>
                       
                    </form>
                </section>
            </div>

            <!-- Columna derecha: Criterio de Búsqueda y Lista de Productos -->
            <div class="col-md-7 mt-4">
                <section class="criterio-busqueda mb-4 p-4">
                    <h4 class="productSection">CRITERIO DE BÚSQUEDA</h4>
                    <!-- Botones de criterio de búsqueda con separación uniforme -->
                    <div class="d-flex gap-2 busqueda">
                        <button class="btn">Búsqueda por Categoría</button>
                        <button class="btn">Búsqueda por Nombre</button>
                        <button class="btn">Producto</button>
                        <button class="btn">Búsqueda por Precio</button>
                    </div>
                </section>

                <section class="lista-productos p-4">
                    <h4 class="mb-3 productSection">LISTA DE PROVEEDORES</h4>
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
                                        <th>APELLIDO</th>
                                        <th>TELEFONO</th>
                                        <th>EMAIL</th>
                                        <th>DIRECCION</th>
                                        <th>RUC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Juan</td>
                                        <td>Pérez</td>
                                        <td>987654321</td>
                                        <td>juan.perez@email.com</td>
                                        <td>Av. Siempre Viva 123</td>
                                        <td>12345678901</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>María</td>
                                        <td>Gómez</td>
                                        <td>987654322</td>
                                        <td>maria.gomez@email.com</td>
                                        <td>Calle Falsa 456</td>
                                        <td>10987654321</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Carlos</td>
                                        <td>López</td>
                                        <td>987654323</td>
                                        <td>carlos.lopez@email.com</td>
                                        <td>Pje. Rivera 789</td>
                                        <td>12345678902</td>
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
   </main>

</html>