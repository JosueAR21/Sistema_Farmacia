<?php
// Incluir archivos de conexión y modelo
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/clienteModel/clienteModel.php');

$database = new Database();
$pdo = $database->getConnection();
$model = new ClienteModel($pdo);

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$id = $_GET['id'] ?? $_POST['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $direccion = $_POST['direccion'] ?? '';

    switch ($action) {
        case 'register':
            $resultado = $model->insertarCliente($nombre, $apellido, $telefono, $direccion, $email);
            echo json_encode(['success' => true, 'message' => $resultado]);
            exit;

        case 'edit':
            if (!empty($id)) {
                $resultado = $model->editarCliente($id, $nombre, $apellido, $telefono, $direccion, $email);
                echo json_encode(['success' => true, 'message' => $resultado]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => "ID del cliente no proporcionado para editar."]);
                exit;
            }

        case 'delete':
            if (!empty($id)) {
                $resultado = $model->eliminarCliente($id);
                echo json_encode(['success' => true, 'message' => $resultado]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'ID del cliente no proporcionado para eliminar.']);
                exit;
            }

        default:
            echo json_encode(['success' => false, 'message' => "Acción no válida."]);
            exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'clientes') {
    $clientes = $model->obtenerClientes();
    $data = [];

    foreach ($clientes as $cliente) {
        $data[] = [
            'Id' => $cliente['Id'],
            'Nombre' => $cliente['Nombre'],
            'Apellido' => $cliente['Apellido'],
            'Telefono' => $cliente['Telefono'],
            'Email' => $cliente['Email'],
            'Dirección' => $cliente['Dirección'],
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
