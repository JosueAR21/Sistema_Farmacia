<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/empleado/empleadoModel.php');

$database = new Database();
$pdo = $database->getConnection();
$model = new EmpleadoModel($pdo);

$roles = $model->obtenerRoles();

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $id_rol = $_POST['id_rol'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['contraseña'] ?? ''; // Obtener la contraseña
    $id = $_POST['id'] ?? '';

    switch ($action) {
        case 'register':
            $resultado = $model->insertarEmpleado($nombre, $apellido, $id_rol, $telefono, $email, $contraseña);
            echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Empleado registrado con éxito.' : 'Error al registrar el empleado.']);
            exit;

        case 'edit':
            if (!empty($id)) {
                $resultado = $model->actualizarEmpleado($id, $nombre, $apellido, $id_rol, $telefono, $email, $contraseña);
                echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Empleado actualizado con éxito.' : 'Error al actualizar el empleado.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del empleado no proporcionado para editar.']);
                exit;
            }

        case 'delete':
            if (!empty($id)) {
                $resultado = $model->eliminarEmpleado($id);
                echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Empleado eliminado con éxito.' : 'Error al eliminar el empleado.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del empleado no proporcionado para eliminar.']);
                exit;
            }

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
}

// Manejar la solicitud AJAX para obtener todos los empleados
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'empleados') {
    $empleados = $model->obtenerEmpleados();
    $data = [];
    foreach ($empleados as $empleado) {
        $data[] = [
            'Id' => $empleado['Id'],
            'Nombre' => $empleado['Nombre'],
            'Apellido' => $empleado['Apellido'],
            'Id_Rol' => $empleado['Id_Rol'],
            'Telefono' => $empleado['Telefono'],
            'Email' => $empleado['Email'],
            'Contraseña' => $empleado['Contraseña']
        ];
    }
    echo json_encode(['data' => $data]);
    exit;
}
?>
