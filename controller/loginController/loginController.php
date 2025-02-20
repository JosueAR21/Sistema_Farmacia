<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/loginModel/loginModel.php');

class LoginController
{
    private $loginModel;

    public function __construct($pdo)
    {
        $this->loginModel = new LoginModel($pdo);
    }

    public function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';

            // Validación de entrada
            if (empty($nombre) || empty($contraseña)) {
                echo json_encode(['status' => 'error', 'message' => 'Nombre y contraseña son requeridos.']);
                exit;
            }

            // Autenticación del usuario
            $usuario = $this->loginModel->autenticarUsuario($nombre, $contraseña);

            if ($usuario) {
                // Autenticación exitosa
                session_start();
                $_SESSION['usuario'] = $usuario; // Almacenar información del usuario en la sesión

                // Obtener el rol del usuario
                $rol = $this->loginModel->obtenerRolPorId($usuario['Id_Rol']);
                if ($rol) {
                    $_SESSION['rol'] = $rol['Nombre']; // Almacena el rol en la sesión
                } else {
                    $_SESSION['rol'] = 'Rol no definido'; // Manejo de error
                }

                // Obtener y almacenar los permisos del rol en la sesión
                $permisos = $this->loginModel->obtenerPermisosPorRol($usuario['Id_Rol']);
                $_SESSION['vistas_permitidas'] = array_column($permisos, 'vista'); // Almacena solo las vistas permitidas

                echo json_encode(['status' => 'success', 'message' => 'Inicio de sesión exitoso.', 'usuario' => $usuario]);
            } else {
                // Autenticación fallida
                echo json_encode(['status' => 'error', 'message' => 'Nombre de usuario o contraseña incorrectos.']);
            }
        }
    }
}

// Crear una instancia del controlador y llamar al método de autenticación
$database = new Database();
$pdo = $database->getConnection();
$controller = new LoginController($pdo);
$controller->autenticar();
