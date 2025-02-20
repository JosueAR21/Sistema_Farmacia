<?php
// Asegúrate de que la ruta sea correcta según tu estructura de carpetas
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/loginController/loginController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/ventas/dashboardController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');


if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    // Asegúrate de que 'Nombre' esté en el array
    $nombreUsuario = isset($usuario['Nombre']) ? $usuario['Nombre'] : 'Invitado';
} else {
    $nombreUsuario = 'Invitado';
}

$rolUsuario = isset($_SESSION['rol']) ? htmlspecialchars($_SESSION['rol']) : 'Rol no definido'; // Obtener rol o mostrar mensaje por defecto



// Verificar si la vista está permitida para el rol del usuario
?>

<!doctype html>
<html lang="en">

<head>
    <title>EkuiFarm - Sistema de Gestión e Inventario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->

</head>

<body class="bodyWelcome">

    <main class="content content-area">
        <div class="mb-4 mt-lg-0">
            <div class="">
                <div class="welcome-grid  d-lg-flex justify-content-between">
                    <div class="welcome" style="white-space: normal;">
                        <h4 class="mt-5  text-start">Bienvenido a EkuiFarm</h1>

                    </div>
                    <div class="perfil">
                        <img src="./assets/img/perfil.png" alt="Perfil" class="perfil-img">
                        <h6 class="text-center"><?php echo htmlspecialchars($nombreUsuario); ?></h6>
                        <h6 class="text-center" style="font-size: 13px; color: gray"><?php echo $rolUsuario; ?></h6>

                    </div>
                </div>
            </div>
            <div>
                <h6 class="tittleDash">Estadísticas Rápidas</h6>
                <div class="info-grid">
                    <div class="infoDash d-flex align-items-center">
                        <div class="info-icon" style="width:42px">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="info-text">
                            <h6 class="stats">Ventas Hoy</h6>
                            <div class="d-flex gap-3">
                                <h5><?php echo $ventasHoy['VentasHoy']; ?></h5>
                                <p class="porcentaje" style="background-color: <?php echo ($porcentajeVentasHoy >= 0 ? 'rgb(198, 255, 198)' : 'rgb(255, 198, 198)'); ?>; color: <?php echo ($porcentajeVentasHoy >= 0 ? 'rgb(13, 231, 13)' : 'rgb(231, 13, 13)'); ?>">
                                    <?php echo ($porcentajeVentasHoy >= 0 ? '+' : '') . round($porcentajeVentasHoy, 2) . '%'; ?>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="infoDash d-flex align-items-center">
                        <div class="info-icon">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                        <div class="info-text">
                            <h6 class="stats">Últimos 7 Días</h6>
                            <div class="d-flex gap-3">
                                <h5><?php echo $ventasUltimos7Dias['VentasUltimos7Dias']; ?></h5>
                                <p class="porcentaje" style="background-color: <?php echo ($porcentajeUltimos7Dias >= 0 ? 'rgb(198, 255, 198)' : 'rgb(255, 198, 198)'); ?>; color: <?php echo ($porcentajeUltimos7Dias >= 0 ? 'rgb(13, 231, 13)' : 'rgb(231, 13, 13)'); ?>">
                                    <?php echo ($porcentajeUltimos7Dias >= 0 ? '+' : '') . round($porcentajeUltimos7Dias, 2) . '%'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="infoDash d-flex align-items-center">
                        <div class="info-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-text">
                            <h6 class="stats">Últimos 30 Días</h6>
                            <div class="d-flex gap-3">
                                <h5><?php echo $ventasUltimos30Dias['VentasUltimos30Dias']; ?></h5>
                                <p class="porcentaje" style="background-color: <?php echo ($porcentajeUltimos30Dias >= 0 ? 'rgb(198, 255, 198)' : 'rgb(255, 198, 198)'); ?>; color: <?php echo ($porcentajeUltimos30Dias >= 0 ? 'rgb(13, 231, 13)' : 'rgb(231, 13, 13)'); ?>">
                                    <?php echo ($porcentajeUltimos30Dias >= 0 ? '+' : '') . round($porcentajeUltimos30Dias, 2) . '%'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="infoDash d-flex align-items-center">
                        <div class="info-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="info-text">
                            <h6 class="stats">Últimos 365 Días</h6>
                            <div class="d-flex gap-3">
                                <h5><?php echo $ventasUltimos365Dias['VentasUltimos365Dias']; ?></h5>
                                <p class="porcentaje" style="background-color: <?php echo ($porcentajeUltimos365Dias >= 0 ? 'rgb(198, 255, 198)' : 'rgb(255, 198, 198)'); ?>; color: <?php echo ($porcentajeUltimos365Dias >= 0 ? 'rgb(13, 231, 13)' : 'rgb(231, 13, 13)'); ?>">
                                    <?php echo ($porcentajeUltimos365Dias >= 0 ? '+' : '') . round($porcentajeUltimos365Dias, 2) . '%'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>

                <div class="charts-grid w-100 d-flex flex-xxl-row">
                    <div class="chart-card">
                        <h2>Ventas Por Mes</h2>
                        <div class="chart-container">
                            <canvas id="ventasChart"></canvas>
                        </div>
                    </div>
                    <div class="chart-card">
                        <h2>Productos Más Vendidos</h2>
                        <div class="chart-container">
                            <canvas id="productosChart"></canvas>
                        </div>
                    </div>
                </div>
                <!--VENTAS RECIENTES-->
                <div class="d-md-flex gap-3 flex-xl-row">
                    <div class="ventas-recientes col-sm-12 col-lg-6 col-md-6 col-xl-6">

                        <h2 class="section-title">Ventas Recientes</h2>
                        <?php foreach ($ventasRecientes as $venta): ?>
                            <h6 class="tiempoDesdeVenta text-end mb-0" style="font-size: 12px ;color: green"><?php echo $venta['TiempoDesdeVenta']; ?> minutos atrás</h6>
                            <div class="product-grid">
                                <div class="imageProduct ms-3">
                                    <img src="assets/img/<?php echo strtolower($venta['Producto']); ?>.png" class="productosVendidos">
                                </div>
                                <div>
                                    <p class="nombreProducto"><?php echo $venta['Producto']; ?></p>
                                    <h6 class="categoriaProducto"><?php echo $venta['Categoria']; ?></h6>
                                </div>
                                <div class="d-sm-flex precio">
                                    <p class="precioProducto">S/ <?php echo $venta['Total']; ?></p>
                                    <h6 class="cantidadProducto" style="font-size: 12px; color: black"><?php echo $venta['Cantidad']; ?> Unidades</h6>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-md-6 seccionNew">
                        <h1>Seccion nueva</h1>
                    </div>
                </div><!---->
            </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ventasPorMes = <?= json_encode($ventasPorMes) ?>;
        const productosMasVendidos = <?= json_encode($productosMasVendidos) ?>;

        const meses = ventasPorMes.map(row => row.Mes);
        const totalVentasPorMes = ventasPorMes.map(row => row.TotalVentas);
        createVentasPorMesChart(meses, totalVentasPorMes);

        const productos = productosMasVendidos.map(row => row.Producto);
        const totalVendidos = productosMasVendidos.map(row => row.TotalVendidos);
        createProductosMasVendidosChart(productos, totalVendidos);

        function createVentasPorMesChart(labels, data) {
            const ctx = document.getElementById('ventasChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Ventas por Mes',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }

        function createProductosMasVendidosChart(labels, data) {
            const ctx = document.getElementById('productosChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Vendidos',
                        data: data,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: true,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }
    </script>

</body>

</html>