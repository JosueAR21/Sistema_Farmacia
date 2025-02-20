<?php
class CategoriaModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todas las categorías
    public function obtenerCategorias() {
        $stmt = $this->db->prepare("EXEC ObtenerCategoria"); // Asumiendo que existe un SP llamado 'ObtenerCategoria'
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una categoría por ID
    public function obtenerCategoriaPorId($id) {
        $stmt = $this->db->prepare("EXEC ObtenerCategoriaPorId :id"); // Asumiendo que existe un SP llamado 'ObtenerCategoriaPorId'
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva categoría
    public function crearCategoria($nombre, $descripcion) {
        $query = "EXEC InsertarCategoria @Nombre = :nombre, @Descripcion = :descripcion";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);

        if ($stmt->execute()) {
            return "Categoría registrada correctamente.";
        } else {
            return "Error al registrar la categoría.";
        }
    }

    // Actualizar una categoría
    public function actualizarCategoria($id, $nombre, $descripcion) {
        $stmt = $this->db->prepare("EXEC ActualizarCategoria @Id = :id, @Nombre = :nombre, @Descripcion = :descripcion");
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);

        if ($stmt->execute()) {
            return "Categoría actualizada correctamente.";
        } else {
            return "Error al actualizar la categoría.";
        }
    }

    // Método para eliminar una categoría
    public function eliminarCategoria($id) {
        try {
            $stmt = $this->db->prepare("EXEC EliminarCategoria :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return "Categoría eliminada exitosamente.";
        } catch (PDOException $e) {
            return "Error al eliminar categoría: " . $e->getMessage();
        }
    }
}
?>
