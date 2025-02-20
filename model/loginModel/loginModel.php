<?php
class LoginModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Función para autenticar a un usuario
    public function autenticarUsuario($nombre, $contraseña) {
        try {
            // Llamar al procedimiento almacenado para obtener todos los empleados
            $stmt = $this->pdo->prepare("EXEC ObtenerEmpleados");
            $stmt->execute();
            $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los empleados

            // Buscar el usuario en la lista de empleados
            foreach ($empleados as $empleado) {
                if ($empleado['Nombre'] === $nombre && $empleado['Contraseña'] === $contraseña) {
                    return $empleado; // Retorna el empleado autenticado
                }
            }
            return false; // Usuario o contraseña incorrectos
        } catch (PDOException $e) {
            return "Error al autenticar usuario: " . $e->getMessage();
        }
    }
    public function obtenerPermisosPorRol($rolId) {
        $sql = "SELECT vista, acceso FROM permisos WHERE rol_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rolId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los permisos en un array asociativo
    }
    
    public function obtenerRolPorId($id_empleado) {
        $stmt = $this->pdo->prepare("EXEC ObtenerRolPorId :id_empleado");
        
        // Vincular el parámetro
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        
        // Ejecutar el procedimiento
        $stmt->execute();

        // Obtener el resultado
        return $stmt->fetch(PDO::FETCH_ASSOC); // Regresar el rol
    }
 
}

?>
