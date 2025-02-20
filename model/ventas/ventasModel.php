<?php


class VentasModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los productos y precios

    public function obtenerProductosYPrecios() {
        $sql = "EXEC ObtenerProductoYPrecio"; // Llamada al procedimiento almacenado
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los productos como un array asociativo
    }
    public function obtenerTodosLosClientes() {
        $query = "EXEC ObtenerCliente";  // Llama al procedimiento almacenado
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un cliente específico por su ID usando ObtenerIdCliente
    public function obtenerClientePorId($idCliente) {
        $query = "EXEC ObtenerIdCliente :Id_Cliente";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':Id_Cliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtenerEmpleados() {
        $query = "EXEC ObtenerEmpleados";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerProductos() {
        $sql = "EXEC ObtenerProducto"; // Llamada al procedimiento almacenado
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los productos como un array asociativo
    }

    // Método para obtener el ID del producto
    public function obtenerIdProducto($idProducto) {
        $sql = "EXEC ObtenerIdProducto :Id_Producto"; // Llamada al procedimiento almacenado
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':Id_Producto', $idProducto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna el producto encontrado o NULL si no se encuentra
    }

    public function obtenerPrecioProducto($idProducto) {
        // Este método ya no es necesario, puedes obtener el precio desde el procedimiento `ObtenerIdProducto`
        $producto = $this->obtenerIdProducto($idProducto);
        return $producto ? $producto['Precio'] : null; // Devuelve el precio o NULL si no se encuentra
    }

    public function generarVenta($idCliente, $idProducto, $idEmpleado, $total, $dni, $nombre, $apellido, $modalidadPago, $cantidad) {
        try {
            $sql = "EXEC GenerarVenta :idCliente, :idProducto, :idEmpleado, :total, :dni, :nombre, :apellido, :modalidadPago, :cantidad";
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
            $stmt->bindParam(':total', $total, PDO::PARAM_STR); // Cambia a PDO::PARAM_DECIMAL si tu base de datos utiliza DECIMAL
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':modalidadPago', $modalidadPago, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    
            $stmt->execute();
            return true; // Devuelve true si la inserción fue exitosa
        } catch (PDOException $e) {
            // Mostrar detalles del error para depuración
            echo "Error al insertar venta: " . $e->getMessage();
            return false; // Devuelve false si hubo un error
        }
    }
    public function actualizarStock($idProducto, $cantidad) {
        $query = "EXEC ActualizarStock @Id = :id, @Cantidad = :cantidad"; // Asegúrate de que los nombres de parámetros coincidan
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $idProducto);
        $stmt->bindParam(':cantidad', $cantidad);
        return $stmt->execute(); // Devuelve true si se ejecuta correctamente
    }
    public function obtenerVentas() {
        // Ejecutar el procedimiento almacenado para obtener las ventas
        $stmt = $this->pdo->prepare("EXEC VisualizarVenta");
        $stmt->execute();
        return $stmt; // Devolver el resultado de la ejecución del procedimiento
    }
    
    
    
}
?>
