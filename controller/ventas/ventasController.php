<?php
// Incluye la configuración y el modelo de ventas
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/ventas/ventasModel.php');

class VentasController {
    private $model;

    public function __construct($pdo) {
        $this->model = new VentasModel($pdo);
    }

    // Método para generar la venta
    public function generarVenta() {
        // Asegúrate de que se envíen datos por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $idCliente = $_POST['id_cliente'];
            $idEmpleado = $_POST['id_empleado'];
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $idProducto = $_POST['id_producto']; 
            $cantidad = $_POST['cantidad'];
            $modalidadPago = $_POST['modalidad_pago'];
        
            // Validar que los campos no estén vacíos (opcional)
            if (empty($idCliente) || empty($idEmpleado) || empty($dni) || empty($nombre) || empty($apellido) || empty($idProducto) || empty($cantidad) || empty($modalidadPago)) {
                echo json_encode(['status' => 'error', 'message' => 'Campos vacíos']);
                exit();
            }
        
            // Obtener el producto por ID
            $producto = $this->model->obtenerIdProducto($idProducto);
            if ($producto === false) {
                echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
                exit();
            }
    
            // Verificar si hay suficiente stock
            $stockDisponible = $producto['Stock']; // Asumimos que 'Stock' es el campo en tu base de datos
            if ($cantidad > $stockDisponible) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Stock insuficiente. Solo hay ' . $stockDisponible . ' unidades disponibles.'
                ]);
                exit();
            }
        
            // Obtener el precio del producto
            $precioUnitario = $producto['Precio'];
            if ($precioUnitario === null) {
                echo json_encode(['status' => 'error', 'message' => 'Error en el precio del producto']);
                exit();
            }
        
            $total = $precioUnitario * $cantidad;
        
            try {
                // Llamar al modelo para generar la venta
                $resultado = $this->model->generarVenta($idCliente, $idProducto, $idEmpleado, $total, $dni, $nombre, $apellido, $modalidadPago, $cantidad);
        
                // Verificar el resultado
                if ($resultado) {
                    // Actualizar el stock del producto después de la venta
                    $this->model->actualizarStock($idProducto, -$cantidad);
                    
                    // Obtener el stock restante después de la venta
                    $productoActualizado = $this->model->obtenerIdProducto($idProducto);
                    $stockRestante = $productoActualizado['Stock'];
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Venta generada con éxito',
                        'stockRestante' => $stockRestante // Devolver el stock restante
                    ]);
                } else {
                    throw new Exception('Error al registrar la venta');
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
            exit();
        }
    }
    
    
    
    

    // Manejar la solicitud AJAX para obtener todas las ventas
    public function obtenerVentas() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'ventas') {
            // Ejecutar el procedimiento almacenado
            $stmt = $this->model->obtenerVentas();
            $data = [];
            while ($venta = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = [
                    'Id_Venta' => $venta['Id_Venta'],
                    'Clientes' => $venta['Clientes'],
                    'Producto' => $venta['Producto'],
                    'Empleado' => $venta['Empleado'],
                    'Fecha' => $venta['Fecha'],
                    'Total' => $venta['Total'],
                    'Cantidad' => $venta['Cantidad']
                ];
            }
            echo json_encode(['data' => $data]);
            exit();
        }
    }
}


// Instanciar la base de datos y el controlador
$database = new Database();
$pdo = $database->getConnection();
$ventasController = new VentasController($pdo);
$model= new VentasModel($pdo);
$productos = $model->obtenerProductos();
$clientes = $model->obtenerTodosLosClientes();
$empleados = $model->obtenerEmpleados();
// Comprobar si se está llamando al método AJAX
if (isset($_GET['ajax'])) {
    if ($_GET['ajax'] === 'ventas') {
        $ventasController->obtenerVentas();
    }
} else {
    // Llamar al método generarVenta si no es una solicitud AJAX
    $ventasController->generarVenta();
}

?>
