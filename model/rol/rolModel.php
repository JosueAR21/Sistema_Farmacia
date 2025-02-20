<?php
class RolModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerRoles() {
        $stmt = $this->pdo->prepare("EXEC ObtenerRolesYEstado");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarRol($nombre, $estado) {
        $stmt = $this->pdo->prepare("EXEC InsertarRol :nombre, :estado");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function actualizarRol($id, $nombre, $estado) {
        $stmt = $this->pdo->prepare("EXEC ActualizarRol :id, :nombre, :estado");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_BOOL);
        return $stmt->execute();
    }
    public function obtenerPermisosPorRol($rolId) {
        $sql = "SELECT vista, acceso FROM permisos WHERE rol_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rolId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los permisos en un array asociativo
    }
    
    
    public function obtenerRolPorId($rolId) {
        // Cambia la consulta SQL para utilizar el procedimiento almacenado
        $sql = "EXEC ObtenerRolPorId ?";
    
        $stmt = $this->pdo->prepare($sql); // Prepara la consulta
        $stmt->bindParam(1, $rolId, PDO::PARAM_INT); // Asocia el parámetro
        $stmt->execute(); // Ejecuta la consulta
    
        // Obtén el resultado como un array asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function anularRol($id) {
        try {
            $stmt = $this->pdo->prepare("EXEC AnularRol :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function eliminarRol($id) {
        $stmt = $this->pdo->prepare("EXEC EliminarRol :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


}

?>
