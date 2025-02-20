<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/ventas/dashboardModel.php');;

$database = new Database();
$pdo = $database->getConnection();

// Crear instancia de EstadisticasVentas
$estadisticasVentas = new EstadisticasVentas($pdo);

// Obtener las estadísticas de ventas
$ventasHoy = $estadisticasVentas->obtenerVentasHoy();
$ventasUltimos7Dias = $estadisticasVentas->obtenerVentasUltimos7Dias();
$ventasUltimos30Dias = $estadisticasVentas->obtenerVentasUltimos30Dias();
$ventasUltimos365Dias = $estadisticasVentas->obtenerVentasUltimos365Dias();
$ventasPorMes = $estadisticasVentas->obtenerVentasPorMes();
$productosMasVendidos = $estadisticasVentas->obtenerProductosMasVendidos();
$ventasRecientes = $estadisticasVentas->obtenerVentasMasRecientes();

// Calcular porcentajes

function calcularPorcentaje($ventasActuales, $ventasAnteriores) {
    if ($ventasAnteriores > 0) {
        return (($ventasActuales - $ventasAnteriores) / $ventasAnteriores) * 100;
    } else {
        return $ventasActuales > 0 ? 100 : 0; // Si no había ventas antes y ahora hay, es un aumento del 100%
    }
}

$porcentajeVentasHoy = calcularPorcentaje($ventasHoy['VentasHoy'], $ventasHoy['VentasAyer']);
$porcentajeUltimos7Dias = calcularPorcentaje($ventasUltimos7Dias['VentasUltimos7Dias'], $ventasUltimos7Dias['Ventas7DiasAntes']);
$porcentajeUltimos30Dias = calcularPorcentaje($ventasUltimos30Dias['VentasUltimos30Dias'], $ventasUltimos30Dias['Ventas30DiasAntes']);
$porcentajeUltimos365Dias = calcularPorcentaje($ventasUltimos365Dias['VentasUltimos365Dias'], $ventasUltimos365Dias['Ventas365DiasAntes']);



?>