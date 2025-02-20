<?php
class ProductoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todos los productos
    public function obtenerMarca() {
        $stmt = $this->db->prepare("EXEC ObtenerMarcas"); // Asumiendo que existe un SP llamado 'ObtenerMarcas'
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerProductos() {
        $stmt = $this->db->prepare("EXEC ObtenerProducto"); // Asumiendo que existe un SP llamado 'ObtenerTodosLosProductos'
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerCategoria() {
        $stmt = $this->db->prepare("EXEC ObtenerCategoria"); // Asumiendo que existe un SP llamado 'ObtenerTodosLosProductos'
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto por ID
    public function obtenerProductoPorId($id) {
        $stmt = $this->db->prepare("EXEC ObtenerIdProducto :id"); // Asumiendo que existe un SP llamado 'ObtenerProductoPorId'
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo producto
    public function crearProducto($nombre, $descripcion, $id_categoria, $id_marca, $precio, $stock) {
        // Procedimiento para insertar un producto
        $query = "EXEC InsertarProducto @Nombre = :nombre, @Descripcion = :descripcion, @Id_Categoria = :id_categoria, @Id_Marca = :id_marca, @Precio = :precio, @Stock = :stock";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':id_marca', $id_marca);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':stock', $stock);

        if ($stmt->execute()) {
            return "Producto registrado correctamente.";
        } else {
            return "Error al registrar el producto.";
        }
    }
    // Actualizar un producto
    public function actualizarProducto($id, $nombre, $descripcion, $id_categoria, $id_marca, $precio, $stock) {
        $stmt = $this->db->prepare("EXEC ActualizarProducto @Id = :id, @Nombre = :nombre, @Descripcion = :descripcion, @Id_Categoria = :id_categoria, @Id_Marca = :id_marca, @Precio = :precio, @Stock = :stock");
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Producto actualizado correctamente.";
        } else {
            return "Error al actualizar el producto.";
        }
    }

    // Método para eliminar producto
    public function eliminarProducto($id) {
        try {
            $stmt = $this->db->prepare("EXEC EliminarProducto :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return "Producto eliminado exitosamente.";
        } catch (PDOException $e) {
            return "Error al eliminar cliente: " . $e->getMessage();
        }
    }
}
?>
