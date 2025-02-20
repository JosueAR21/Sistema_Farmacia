<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/ventas/ventasController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');
?>
<!doctype html>
<html lang="en">

<head>

    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/productos.css">
    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/ventas.css">
</head>

<main class="content content-area">
    <div class="my-4 productos">
        <h2 class="mb-4">Modulo de Ventas</h2>
        <form method="POST" action="http://localhost/EkuiFarm-Frontend/controller/ventas/ventasController.php" id="ventasForm">
            <div class="row">
                <div class="col-md-4">
                    <section class="gestion-productos mb-4 p-4">
                        <h4 class="mb-4 productSection">ACCIONES</h4>
                        <div class="d-grid gap-2 botones2">
                            <div class="d-flex flex-wrap justify-content-between gap-2">
                                <button type="button" class="btn btn-primary flex-grow-1 me-1">Añadir</button>
                                <button type="button" class="btn btn-danger flex-grow-1 mx-1">Eliminar</button>
                                <button type="button" class="btn btn-success flex-grow-1 mx-1">Editar</button>
                                <button type="button" class="btn btn-muted flex-grow-1 ms-1"
                                    style="background-color: rgba(0,0,0,0.4); color: white">Limpiar</button>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <a class="btn btn-secondary me-2 text-white w-25" href="http://localhost/EkuiFarm-Frontend/view/ventas/buscar.php">Buscar</a>
                            </div>
                        </div>
                    </section>

                    <section class="registrar-producto p-4">
                        <h4 class="productSection">DATOS DEL CLIENTE</h4>
                        <div class="mb-3">
                            <label for="cliente" class="form-label">CLIENTE:</label>
                            <select name="id_cliente" id="id_cliente" required class="input" style="font-size: 13px">
                                <option value="">Seleccionar cliente</option>
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?= $cliente['Id'] ?>"><?= htmlspecialchars($cliente['Nombre'] . ' ' . $cliente['Apellido']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="empleado" class="form-label">EMPLEADO:</label>
                            <select name="id_empleado" id="id_empleado" required class="input" style="font-size: 13px">
                                <option value="">Seleccionar vendedor</option>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?= $empleado['Id'] ?>">
                                        <?= htmlspecialchars($empleado['Nombre'] . ' ' . $empleado['Apellido']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DOCUMENTO DNI:</label>
                            <input type="text" class="input" id="dni" name="dni" pattern="\d{8}" title="El DNI debe contener 8 dígitos" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">NOMBRE:</label>
                            <input type="text" class="input" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">APELLIDO:</label>
                            <input type="text" class="input" id="apellido" name="apellido" required>
                        </div>
                    </section>
                </div>

                <div class="col-md-8">
                    <section class="criterio-busqueda mb-4 p-4">
                        <h4 class="productSection">Detalle de Ventas</h4>
                        <div class="d-flex flex-md-column gap-4 flex-xl-row pt-3">
                            <div class="col-xl-6">
                                <div class="d-flex mb-3 align-items-center gap-3">
                                    <label for="producto" class="form-label text-start">Producto</label>
                                    <select id="producto" class="form-select" name="id_producto" required onchange="actualizarCampos()">
                                        <option>Seleccione un Producto</option>
                                        <?php foreach ($productos as $producto): ?>
                                            <option value="<?= $producto['Id'] ?>" data-precio="<?= $producto['Precio'] ?>">
                                                <?= htmlspecialchars($producto['Nombre']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="d-flex mb-3 align-items-center gap-3">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" min="1" required oninput="calcularTotal()">
                                </div>

                                <div class="mb-3 d-block precios">
                                    <p id="precioBruto">Precio Bruto: $0.00</p>
                                    <p id="precioUnitario">Precio Unitario: $0.00</p>
                                    <p id="total">Total: $0.00</p>
                                </div>


                                <div class="mb-3 d-flex gap-3 align-items-center">
                                    <label>Modalidad de Pago</label>
                                    <select class="form-select" name="modalidad_pago" required>
                                        <option selected>Seleccionar metodo de pago</option>
                                        <option>Yape</option>
                                        <option>QR</option>
                                        <option>Efectivo</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-success" onclick="agregarAlCarrito()">Añadir</button>
                                <button type="submit" class="btn btn-success">Generar Venta</button>
                            </div>

                            <div class="col-xl-6 detalle">
                                <h3>Productos</h3>
                                <ul id="carrito" class="list-group">
                                    <!-- Aquí se añadirán los productos -->
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="carrito_data" id="carrito_data">
                    </section>
                    <section class="lista-productos p-4">
                        <h4 class="mb-3 productSection">Ventas Registradas</h4>
                        
                       
                        <div class="container mb-2">
                            <div class="table-wrapper">
                                <table id="ventasTable" class="table table-hover text-center" style="cursor: pointer;">
                                    <thead>
                                        <tr>
                                            <th>ID_VENTA</th>
                                            <th>CLIENTE</th>
                                            <th>PRODUCTO</th>
                                            <th>EMPLEADO</th>
                                            <th>FECHA_VENTA</th>
                                            <th>TOTAL</th>
                                            <th>CANTIDAD</th>
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
        </form>
    </div>
    <div class="modal fade" id="modalImpresion" tabindex="-1" role="dialog" aria-labelledby="modalImpresionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImpresionLabel">Seleccionar tipo de impresión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idVenta" value="">
                    <p>Seleccione el tipo de impresión:</p>
                    <div class="form-group">
                        <select class="form-control" id="tipoImpresion">
                            <option value="boleta">Boleta</option>
                            <option value="factura">Factura</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="imprimir()">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
   $(document).ready(function() {
    var table = $('#ventasTable').DataTable({
        ajax: {
            url: 'http://localhost/Ekuifarm-Frontend/controller/ventas/ventasController.php?ajax=ventas', // URL del controlador que devuelve los datos
            dataSrc: 'data' // Ruta en la respuesta que contiene los datos
        },
        columns: [{
                data: 'Id_Venta'
            },
            {
                data: 'Clientes'
            },
            {
                data: 'Producto'
            },
            {
                data: 'Empleado'
            },
            {
                data: 'Fecha'
            },
            {
                data: 'Total'
            },
            {
                data: 'Cantidad'
            }
        ],
        paging: true, // Paginación activada
        pageLength: 10, // Mostrar 10 registros por página
        lengthChange: false, // No permitir cambiar el número de registros por página
        searching: true, // Búsqueda activada
        ordering: false, // Desactivar ordenación
        info: true, // Información activada (p.ej., "Mostrando 1 a 10 de 100")
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json" // Traducción al español
        }
    });

    // Actualizar el total de registros cada vez que se dibuje la tabla
    $('#ventasTable').on('draw.dt', function() {
        var info = table.page.info();
        $('#total-registros').text(`Total de registros: ${info.recordsTotal}`);
    });

    // Al enviar el formulario de ventas
    $("#ventasForm").submit(function(event) {
        event.preventDefault(); // Prevenir el envío tradicional

        // Recoger los datos del formulario
        var formData = $(this).serialize();

        // Hacer la solicitud AJAX
        $.ajax({
            url: "http://localhost/Ekuifarm-Frontend/controller/ventas/ventasController.php", // URL de tu controlador PHP
            type: "POST",
            data: formData, // Datos del formulario
            dataType: "json", // Esperamos una respuesta JSON
            success: function(response) {
                // Manejar la respuesta
                if (response.status === 'success') {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Venta realizada',
                        text: response.message,
                    });

                    // Limpiar el formulario
                    $('#ventasForm')[0].reset();

                    // Recargar la tabla de ventas
                    table.ajax.reload();
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                // Manejar el error de la solicitud
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'Hubo un problema al procesar la venta. Inténtalo de nuevo.',
                });
            }
        });
    });
});

    document.getElementById('ventasForm').addEventListener('submit', function(event) {
        if (document.getElementById('id_cliente').value === '' ||
            document.getElementById('id_empleado').value === '' ||
            document.getElementById('dni').value === '' ||
            document.getElementById('nombre').value === '' ||
            document.getElementById('apellido').value === '' ||
            document.getElementById('producto').value === '' ||
            document.getElementById('cantidad').value <= 0 ||
            document.querySelector('[name="modalidad_pago"]').value === '') {
            alert('Por favor, completa todos los campos antes de enviar el formulario.');
            event.preventDefault();
        }
    });
</script>
<script src="http://localhost/Ekuifarm-Frontend/assets/js/ventas/ventas.js"></script>

</html>