<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/productoController/productoController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/productos.css">

</head>

<main class="content content-area">
    <div class="my-4 productos">
        <h2 class="mb-4 mt-5">Modulo de Productos</h2>
        <div class="row">
            <div class="col-md-4">
                <section class="gestion-productos mb-4 p-4">
                    <h4 class="mb-4 productSection">ACCIONES</h4>
                    <div class="d-grid gap-2 botones2">
                        <div class="d-flex flex-wrap justify-content-between gap-2">
                            <button class="btn btn-primary flex-grow-1 me-1" onclick="cambiarTitulo('register')">Añadir</button>
                            <button class="btn btn-danger flex-grow-1 mx-1" onclick="cambiarTitulo('delete')">Eliminar</button>
                            <button class="btn btn-success flex-grow-1 mx-1" onclick="cambiarTitulo('edit')">Editar</button>
                            <button class="btn btn-secondary flex-grow-1 ms-1" id="limpiarForm">Limpiar</button>
                        </div>
                    </div>
                </section>

                <section class="registrar-producto p-4">
                    <h4 class="productSection action">REGISTRO DE PRODUCTOS</h4>
                    <form class="d-block mt-4" id="formEditarProducto">
                        <input type="hidden" name="id" id="idProducto" value="<?= $producto['Id'] ?? ''; ?>" />
                        <input type="hidden" name="action" id="action" value="register">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">NOMBRE DEL PRODUCTO:</label>
                            <input type="text" class="input" name="nombre" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">DESCRIPCION:</label>
                            <input type="text" class="input" name="descripcion" id="descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">CATEGORÍA:</label>
                            <select name="categoria" id="categoria" required class="input" style="font-size: 13px">
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['Id'] ?>"><?= $categoria['Nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">MARCA:</label>
                            <select name="marca" id="marca" required class="input" style="font-size: 13px">
                                <option value="">Seleccione una marca</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?= $marca['Id'] ?>"><?= $marca['Nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">PRECIO:</label>
                            <input type="number" class="input" name="precio" id="precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">STOCK:</label>
                            <input type="number" class="input" name="stock" id="stock" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Registrar</button>
                        <button type="button" class="btn btn-secondary" id="btnCancelar" style="display:none;" onclick="cancelarEdicion()">Cancelar</button>
                    </form>
                </section>
            </div>

            <div class="col-md-8">
                <section class="lista-productos p-4">
                    <h4 class="mb-3 productSection">LISTADO DE PRODUCTOS</h4>
                    <div class="table-wrapper">
                        <table class="table table-hover text-center" id="tablaProductos" style="z-index: -1000">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">NOMBRE</th>
                                    <th class="text-center">DESCRIPCION</th>
                                    <th class="text-center">ID_CATEGORIA</th>
                                    <th class="text-center">ID_MARCA</th>
                                    <th class="text-center">PRECIO</th>
                                    <th class="text-center">STOCK</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>

                        </table>
                    </div>

                </section>

            </div>
        </div>
    </div>
    <script src="http://localhost/Ekuifarm-Frontend/assets/js/productos/productos.js"></script>
</main>


</html>