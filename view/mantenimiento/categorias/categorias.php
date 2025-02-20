<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/categoriaController/categoriaController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/productos.css">
</head>

<body>
<main class="content content-area">
    <div class="my-4 productos">
        <h2 class="mb-4">Modulo de Categorías</h2>
        <div class="row">
            <div class="col-md-4">
                <section class="registrar-producto p-4">
                    <h4 id="formTitle" class="productSection mb-4">REGISTRAR CATEGORÍA</h4>
                    <form id="formCategoria">
                        <input type="hidden" name="id" id="idCategoria">
                        <input type="hidden" name="action" id="action" value="register">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">NOMBRE:</label>
                            <input type="text" class="input" name="nombre" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">DESCRIPCIÓN:</label>
                            <input type="text" class="input" name="descripcion" id="descripcion" required>
                        </div>
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Registrar</button>
                        <button type="button" id="btnCancelar" class="btn btn-secondary" onclick="cancelarEdicion()" style="display:none;">Cancelar</button>
                    </form>
                </section>
            </div>

            <div class="col-md-8 mt-4">
                <section class="lista-productos p-4">
                    <h4 class="productSection">LISTA DE CATEGORÍAS</h4>
                    <div class="table-wrapper">
                    <table class="table table-hover" id="tablaCategorias">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

    <script src="http://localhost/Ekuifarm-Frontend/assets/js/categorias/categorias.js"></script>
</body>

</html>