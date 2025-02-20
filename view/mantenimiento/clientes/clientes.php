<?php
// Asegúrate de que la ruta sea correcta según tu estructura de carpetas
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/clienteController/clienteController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>

    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/productos.css">
    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/darkmode.css"
        id="dark-mode-stylesheet" disabled>

</head>

    <main class="content content-area">
        <div class=" my-4 productos">
            <!-- Título principal -->
            <h2 class="mb-4 mt-5">Modulo de Clientes</h2>

            <div class="row">
                <!-- Columna izquierda: Acciones y Registro de Producto -->
                <div class="col-md-4">
                    <section class="gestion-productos mb-4 p-4">
                        <h4 class="mb-4 productSection">ACCIONES</h4>
                        <div class="d-grid gap-2 botones2">
                            <div class="d-flex flex-wrap justify-content-between gap-2">
                                <button class="btn btn-primary flex-grow-1 me-1">Añadir</button>
                                <button class="btn btn-danger flex-grow-1 mx-1">Eliminar</button>
                                <button class="btn btn-success flex-grow-1 mx-1">Editar</button>
                                <button class="btn btn-secondary flex-grow-1 ms-1" id="limpiarForm">Limpiar</button>
                            </div>
                        </div>
                    </section>

                    <section class="registrar-producto p-4">
                        <h4 class="productSection action">REGISTRO DE CLIENTES</h4>
                        <form class="d-block mt-4"
                            action="http://localhost/Ekuifarm-Frontend/controller/clienteController/clienteController.php"
                            method="POST" id="formEditarCliente">
                            <input type="hidden" name="id" id="idCliente" value="<?= $cliente['Id'] ?? ''; ?>" />
                            <input type="hidden" name="action" id="action" value="register">
                            <!-- Valor inicial es "register" -->

                            <div class="mb-3">
                                <label for="nombre" class="form-label">NOMBRE:</label>
                                <input type="text" class="input" name="nombre" id="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">APELLIDO:</label>
                                <input type="text" class="input" name="apellido" id="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">TELEFONO:</label>
                                <input type="tel" class="input" name="telefono" id="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">EMAIL:</label>
                                <input type="email" class="input" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">DIRECCIÓN:</label>
                                <input type="text" class="input" name="direccion" id="direccion" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Registrar</button>
                            <button type="button" class="btn btn-secondary" id="btnCancelar" style="display:none;" onclick="cancelarEdicion()">Cancelar</button>

                        </form>

                    </section>

                </div>

                <!-- Columna derecha: Criterio de Búsqueda y Lista de Productos -->
                <div class="col-md-8">
                    <section class="lista-productos p-4">
                        <h4 class="mb-3 productSection">LISTADO DE CLIENTES</h4>                    
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="multiSelect" checked />
                            <label class="form-check-label" for="multiSelect"
                                style="font-weight: 600; font-size: 14px">Selección Múltiple</label>
                        </div>
                        <div class="container mb-2">
                            <div class="table-wrapper">
                                <table class="table table-hover text-center" style="cursor: pointer;" id="tablaClientes">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">NOMBRE</th>
                                            <th class="text-center">APELLIDO</th>
                                            <th class="text-center">TELEFONO</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">DIRECCION</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </section>
                </div>
            </div>
        </div>
        </div>
        <!-- Bootstrap JS -->
    </main>
<script src="http://localhost/Ekuifarm-Frontend/assets/js/clientes/clientes.js"></script>
</html>