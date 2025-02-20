<?php
class ClienteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertarCliente($nombre, $apellido, $telefono, $direccion, $email) {
        try {
            $stmt = $this->pdo->prepare("EXEC InsertarCliente :nombre, :apellido, :telefono, :direccion, :email");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return "Cliente registrado exitosamente.";
        } catch (PDOException $e) {
            return "Error al insertar cliente: " . $e->getMessage();
        }
    }

    public function obtenerClientes() {
        try {
            $stmt = $this->pdo->query("EXEC ObtenerCliente");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; // Devuelve un array vacío si hay un error
        }
    }

    public function obtenerClientePorId($idCliente) {
        try {
            $stmt = $this->pdo->prepare("EXEC ObtenerIdCliente :idCliente");
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error al obtener cliente: " . $e->getMessage();
        }
    }

    public function editarCliente($idCliente, $nombre, $apellido, $telefono, $direccion, $email) {
        try {
            $stmt = $this->pdo->prepare("EXEC EditarCliente :idCliente, :nombre, :apellido, :telefono, :direccion, :email");
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return "Cliente actualizado exitosamente.";
        } catch (PDOException $e) {
            return "Error al actualizar cliente: " . $e->getMessage();
        }
    }

    public function eliminarCliente($idCliente) {
        try {
            $stmt = $this->pdo->prepare("EXEC EliminarCliente :idCliente");
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();

            return "Cliente eliminado exitosamente.";
        } catch (PDOException $e) {
            return "Error al eliminar cliente: " . $e->getMessage();
        }
    }
}
?>
