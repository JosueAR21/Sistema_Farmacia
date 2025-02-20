<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/rol/rolModel.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/rol/permisoModel.php'); // Incluye el modelo de permisos

$database = new Database();
$pdo = $database->getConnection();
$model = new RolModel($pdo);
$permisoModel = new PermisoModel($pdo); // Crea una instancia del modelo de permisos

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $estado = $_POST['estado'] ?? 1;
    $id = $_POST['id'] ?? '';

    switch ($action) {
        case 'register':
            $resultado = $model->insertarRol($nombre, $estado);
            echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Rol registrado con éxito.' : 'Error al registrar el rol.']);
            exit;

        case 'edit':
            if (!empty($id)) {
                $resultado = $model->actualizarRol($id, $nombre, $estado);
                echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Rol actualizado con éxito.' : 'Error al actualizar el rol.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del rol no proporcionado para editar.']);
                exit;
            }

        case 'delete':
            if (!empty($id)) {
                $resultado = $model->eliminarRol($id);
                echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Rol eliminado con éxito.' : 'Error al eliminar el rol.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del rol no proporcionado para eliminar.']);
                exit;
            }

        case 'deactivate':
            $id = $_POST['id'] ?? '';
            if (!empty($id)) {
                $resultado = $model->anularRol($id);
                echo json_encode(['status' => $resultado ? 'success' : 'error', 'message' => $resultado ? 'Rol desactivado con éxito.' : 'Error al desactivar el rol.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID del rol no proporcionado.']);
            }
            break;

            case 'assignPermissions':
                $permisos = json_decode($_POST['permisos'], true);
                
                if (!is_array($permisos)) {
                    echo json_encode(['status' => 'error', 'message' => 'Formato de permisos inválido.']);
                    break;
                }
                
                $resultados = [];
                
                foreach ($permisos as $permiso) {
                    $rolId = $permiso['rol_id'] ?? null; // ID del rol
                    $vista = $permiso['vista'] ?? null; // Nombre de la vista
                    $acceso = isset($permiso['acceso']) ? (int)$permiso['acceso'] : 0; // Acceso como 0 o 1
                    
                    if (!empty($rolId) && !empty($vista)) {
                        $resultado = $permisoModel->asignarPermiso($rolId, $vista, $acceso);
                        $resultados[] = [
                            'status' => $resultado ? 'success' : 'error',
                            'message' => $resultado ? 'Permiso asignado con éxito.' : 'Error al asignar el permiso.',
                            'rol_id' => $rolId,
                            'vista' => $vista
                        ];
                    } else {
                        $resultados[] = [
                            'status' => 'error',
                            'message' => 'ID de rol o vista no proporcionados.',
                            'rol_id' => $rolId,
                            'vista' => $vista
                        ];
                    }
                }
                
                echo json_encode($resultados);
                break;
            
            
            

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
}

// Manejar la solicitud AJAX para obtener todos los roles
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'roles') {
    $roles = $model->obtenerRoles();
    $data = [];
    foreach ($roles as $rol) {
        $data[] = [
            'Id' => $rol['Id'],
            'Nombre' => $rol['Nombre'],
            'Estado' => $rol['Estado']
        ];
    }
    echo json_encode(['data' => $data]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax']) && $_GET['ajax'] == 'roles2' && isset($_GET['rolId'])) {
    // Intenta ejecutar el código
    try {
        // Obtén el ID del rol de la solicitud
        $rolId = $_GET['rolId'];

        // Procesar la solicitud
        $response = processRoleRequest($rolId, $model);
        echo json_encode($response);
    } catch (Exception $e) {
        // Captura errores y muestra un mensaje de error
        echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
    }
    exit;
}

// Función para procesar la solicitud del rol
function processRoleRequest($rolId, $model)
{
    // Obtén el rol por ID
    $rol = $model->obtenerRolPorId($rolId);

    if ($rol) {
        // Obtener permisos por rol
        $permisos = $model->obtenerPermisosPorRol($rolId);

        // Asegúrate de que los permisos estén en el formato correcto
        if (!is_array($permisos)) {
            return ['error' => 'No se pudieron obtener los permisos.'];
        }

        // Construye el arreglo de respuesta
        return [
            'data' => [
                'Id' => $rolId,
                'Nombre' => $rol['Nombre'],
                'Permisos' => $permisos // Solo se agregan permisos
            ]
        ];
    } else {
        return ['error' => 'Rol no encontrado.'];
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'assignPermissions') {
    try {
        $permisos = json_decode($_POST['permisos'], true);

        foreach ($permisos as $permiso) {
            $rolId = $permiso['rol_id'];
            $vista = $permiso['vista'];
            $acceso = $permiso['acceso'];

            if (!is_int($rolId)) {
                throw new Exception("El rol ID debe ser un entero. Recibido: " . var_export($rolId, true));
            }

            $asignado = $permisoModel->asignarPermiso($rolId, $vista, $acceso);
        }

        // Devuelve el resultado
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
    }
}
