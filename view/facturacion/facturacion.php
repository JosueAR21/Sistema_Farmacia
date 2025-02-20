<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/facturacion/facturacionController.php');
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="http://localhost/EkuiFarm-Frontend/assets/css/facturacion.css">
</head>

<body class="bodyFact">
<main class="content content-area">
    <div class="my-4 facturacion">
        <!-- Título principal -->
        <h2 class="mb-4">Modulo de Facturación</h2>

        <!-- Hace que las secciones de acciones y búsqueda se comporten de forma responsiva -->
        <div class="d-md-flex d-sm-block flex-wrap gap-3 gestion">
            <!-- Sección Acciones -->
            <section class="gestion-facturación mb-4 p-4 flex-grow-1" style="height: max-content;">
                <h4 class="mb-4 factSection">ACCIONES</h4>
                <!-- Contenedor con separación uniforme -->
                <div class="d-grid gap-2 botones2">
                    <div class="d-flex flex-wrap justify-content-between">
                        <button type="button" class="btn btn-danger flex-grow-1 me-1" data-bs-toggle="modal"
                            data-bs-target="#anularModal">Anular</button>
                        <button class="btn flex-grow-1 ms-2 text-white me-3"
                            style="background-color:rgb(123, 83, 161)">Actualizar Filtros</button>

                        <button class="btn btn-success flex-grow-1 me-2 text-white">Eliminar</button>
                        <button class="btn flex-grow-1 ms-2 text-white"
                            style="background-color: skyblue">Imprimir</button>

                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="align-items-center" style="display:flex; flex-direction: row-reverse">
                            <label>Boleta</label>
                            <input type="checkbox" class="form-check">
                        </div>
                        <div class="align-items-center" style="display:flex; flex-direction: row-reverse">
                            <label>Factura</label>
                            <input type="checkbox" class="form-check">
                        </div>
                        <button class="btn ms-2"
                            style="background-color:#ffb703">Generar Comprobante</button>
                    </div>
                </div>
            </section>
            <!--MODAL ANULACION DE FACTURA-->
            <div class="modal fade" id="anularModal" tabindex="-1" aria-labelledby="anularModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="anularModalLabel">ANULAR FACTURA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 style="font-size: 20px;">Confirmar Anulación</h6>
                                <p>Estás seguro de deseas anular la factura 021?</p>
                                <h6 class="mb-3">ID_FACTURA: 1</h6>
                                <h6 class="mb-3">ID_VENTA: 3</h6>
                                <h6 class="mb-3">FECHA: 2024/10/01</h6>
                                <h6 class="mb-3">TOTAL: S/25.85</h6>
                                <h6 class="mb-3">ID_CLIENTE: 103</h6>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                style="font-size: 14px;">Cancelar</button>
                            <button type="button" class="btn btn-success" style="font-size: 14px;"
                                onclick="confirmarAnulacion()">Confirmar
                                Anulación</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL NUEVA FACTURA -->
            <div class="modal fade" id="nuevaFacturaModal" tabindex="-1" aria-labelledby="nuevaFacturaModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nuevaFacturaModalLabel">Generar Factura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-lg-3 d-block">
                                        <label for="idVenta" class="form-label">ID_VENTA</label>
                                        <input type="text" id="idVenta" placeholder="">
                                    </div>
                                    <div class="col-lg-3 d-block">
                                        <label for="idFactura" class="form-label">ID_FACTURA</label>
                                        <input type="text" id="idFactura" placeholder="">
                                    </div>
                                    <div class="col-lg-3 d-block">
                                        <label for="fecha" class="form-label">FECHA</label>
                                        <input type="date" id="fecha">
                                    </div>
                                    <div class="col-lg-3 d-block">
                                        <label for="idCliente" class="form-label">ID_CLIENTE</label>
                                        <input type="text" id="idCliente" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 d-block">
                                        <label for="total" class="form-label">TOTAL</label>
                                        <input type="number" id="total" placeholder="">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn text-white" data-bs-dismiss="modal"
                                style="background-color: #b5b5b5;">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="btnGenerar">Generar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--NOTIFICACIONES-->
            <div class="toast-container position-fixed top-0 end-0 p-3" id="toast-container">
                <div class="toast" id="toastAnulacion" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header d-flex align-items-start">
                        <div class="icon-container me-2">
                            <i class="fa-regular fa-circle-check" style="color: rgb(40, 170, 0);"></i>
                        </div>
                        <div class="me-auto">
                            <h5 class="mb-0">La Factura ha sido anulada con éxito</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>




            <!-- Sección Criterio de Búsqueda -->
            <section class="criterio-busqueda1 mb-4 p-4 flex-grow-1" style="height: max-content;">
                <h4 class="factSection">CRITERIO DE BÚSQUEDA</h4>
                <div class="d-flex gap-2 busqueda mt-3">
                    <button class="btn">Búsqueda por Categoría</button>
                    <button class="btn">Búsqueda por Nombre</button>
                    <button class="btn">Producto</button>
                    <button class="btn">Búsqueda por Precio</button>
                </div>
            </section>
        </div>

        <!-- Columna derecha: Lista de Productos -->
        <div class="col-md-12 mt-4">
            <section class="lista-productos p-4">
                <h4 class="mb-3 factSection">LISTA DE FACTURACIÓN</h4>
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
                                    <th>ID_FACTURA</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Empleado</th>
                                    <th>Fecha-Emision</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($facturas)): ?>
                                    <?php foreach ($facturas as $factura): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($factura['Id_factura']) ?></td>
                                            <td><?= htmlspecialchars($factura['Nombre_Cliente']) ?></td>
                                            <td><?= htmlspecialchars($factura['Producto']) ?></td>
                                            <td><?= htmlspecialchars($factura['Cantidad']) ?></td>
                                            <td><?= htmlspecialchars($factura['Nombre_Empleado']) ?></td>
                                            <td><?= htmlspecialchars($factura['Fecha_Emision']) ?></td>
                                            <td><?= htmlspecialchars($factura['Monto_Total']) ?></td>
                                            <td>
                                            <a href="/Ekuifarm-Frontend/controller/facturacion/facturacionController.php?action=generarPDF&idFactura=<?php echo $factura['Id_factura']; ?>" class="btn btn-primary" target="_blank">Generar PDF</a>
                                            </td>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">No se encontraron facturas.</td>
                                    </tr>
                                <?php endif; ?>
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
</main>
</body>

</html>