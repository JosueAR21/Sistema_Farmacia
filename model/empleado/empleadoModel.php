<?php
class EmpleadoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todos los empleados
    public function obtenerEmpleados() {
        $stmt = $this->db->prepare("EXEC ObtenerEmpleados");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener roles
    public function obtenerRoles() {
        $stmt = $this->db->prepare("EXEC ObtenerRoles");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo empleado
    public function insertarEmpleado($nombre, $apellido, $id_rol, $telefono, $email, $contraseña) {
        $stmt = $this->db->prepare("EXEC InsertarEmpleado ?, ?, ?, ?, ?, ?");
        // No hashear la contraseña
        return $stmt->execute([$nombre, $apellido, $id_rol, $telefono, $email, $contraseña]);
    }

    // Actualizar empleado
    public function actualizarEmpleado($id, $nombre, $apellido, $id_rol, $telefono, $email, $contraseña) {
        $stmt = $this->db->prepare("EXEC ActualizarEmpleado ?, ?, ?, ?, ?, ?, ?");
        // No hashear la contraseña
        return $stmt->execute([$id, $nombre, $apellido, $id_rol, $telefono, $email, $contraseña]);
    }

    // Eliminar empleado
    public function eliminarEmpleado($id) {
        $stmt = $this->db->prepare("EXEC EliminarEmpleado ?");
        return $stmt->execute([$id]);
    }
}

?>
