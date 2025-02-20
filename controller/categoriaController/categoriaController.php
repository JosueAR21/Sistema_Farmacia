<?php
// Incluir archivos de conexión y modelo
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/categoriaModel/categoriaModel.php');

$database = new Database();
$pdo = $database->getConnection();
$model = new CategoriaModel($pdo);

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$id = $_GET['id'] ?? $_POST['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    switch ($action) {
        case 'register':
            $resultado = $model->crearCategoria($nombre, $descripcion);
            echo json_encode(['success' => true, 'message' => $resultado]);
            exit;

        case 'edit':
            if (!empty($id)) {
                $resultado = $model->actualizarCategoria($id, $nombre, $descripcion);
                echo json_encode(['success' => true, 'message' => $resultado]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => "ID de la categoría no proporcionado para editar."]);
                exit;
            }

        case 'delete':
            if (!empty($id)) {
                $resultado = $model->eliminarCategoria($id);
                echo json_encode(['success' => true, 'message' => $resultado]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'ID de la categoría no proporcionado para eliminar.']);
                exit;
            }

        default:
            echo json_encode(['success' => false, 'message' => "Acción no válida."]);
            exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'categorias') {
    $categorias = $model->obtenerCategorias();
    $data = [];

    foreach ($categorias as $categoria) {
        $data[] = [
            'Id' => $categoria['Id'],
            'Nombre' => $categoria['Nombre'],
            'Descripcion' => $categoria['Descripcion'],
        ];
    }

    $response = [
        'data' => $data,
        'recordsTotal' => count($data),
        'recordsFiltered' => count($data)
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
