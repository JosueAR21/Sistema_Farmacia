<?php
class PermisoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Métodos de gestión de permisos
    

    public function asignarPermiso($rolId, $vista, $acceso) {
        try {
            $sql = "EXEC asignarPermiso :rolId, :vista, :acceso";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':rolId' => $rolId, ':vista' => $vista, ':acceso' => (bool)$acceso]);
            return ['status' => 'success', 'message' => 'Permiso asignado correctamente.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage(), 'rol_id' => $rolId, 'vista' => $vista];
        }
    }
    
    public function actualizarPermiso($rolId, $vista, $acceso) {
        $stmt = $this->pdo->prepare("EXEC ActualizarPermiso :rolId, :vista, :acceso");
        $stmt->bindParam(':rolId', $rolId, PDO::PARAM_INT);
        $stmt->bindParam(':vista', $vista, PDO::PARAM_STR);
        $stmt->bindParam(':acceso', $acceso, PDO::PARAM_BOOL);
        return $stmt->execute();
    }
}
?>
