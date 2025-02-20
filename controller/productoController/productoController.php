<?php
// Incluir archivos de conexión y modelo
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/productoModel/productoModel.php');

// Crear una instancia de la base de datos y del modelo
$database = new Database();
$pdo = $database->getConnection();
$model = new ProductoModel($pdo);

$categorias= $model->obtenerCategoria();
$marcas= $model->obtenerMarca();

// Obtener la acción y el ID del producto
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $id_categoria = $_POST['categoria'] ?? '';
    $id_marca = $_POST['marca'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $id = $_POST['id'] ?? ''; // Para la edición y eliminación

    switch ($action) {
        case 'register':
            $resultado = $model->crearProducto($nombre, $descripcion, $id_categoria, $id_marca, $precio, $stock);
            echo json_encode(['status' => 'success', 'message' => 'Producto registrado con éxito.']);
            exit;

        case 'edit':
            if (!empty($id)) {
                $resultado = $model->actualizarProducto($id, $nombre, $descripcion, $id_categoria, $id_marca, $precio, $stock);
                echo json_encode(['status' => 'success', 'message' => 'Producto actualizado con éxito.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del producto no proporcionado para editar.']);
                exit;
            }

        case 'delete':
            if (!empty($id)) {
                $resultado = $model->eliminarProducto($id);
                echo json_encode(['status' => 'success', 'message' => 'Producto eliminado con éxito.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del producto no proporcionado para eliminar.']);
                exit;
            }

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
}

// Manejar la solicitud AJAX para obtener todos los productos
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'productos') {
    $productos = $model->obtenerProductos();
    $data = [];
    foreach ($productos as $producto) {
        $data[] = [
            'Id' => $producto['Id'],
            'Nombre' => $producto['Nombre'],
            'Descripcion' => $producto['Descripcion'],
            'Id_Categoria' => $producto['Id_Categoria'],
            'Id_Marca' => $producto['Id_Marca'],
            'Precio' => $producto['Precio'],
            'Stock' => $producto['Stock'],
        ];
    }
    echo json_encode(['data' => $data]);
    exit;
}
?>
