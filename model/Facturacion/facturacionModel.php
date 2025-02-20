<?php
class FacturacionModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

    // Método para obtener todas las facturas
    public function VisualizarFacturacion() {
        $query = "EXEC sp_VisualizarFacturaVenta1";  // Llama al procedimiento almacenado para todas las facturas
        $stmt = $this->pdo->query($query);  
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerFacturaVenta($idFactura) {
        $stmt = $this->pdo->prepare("EXEC sp_ObtenerFacturaVentaPorId :idFactura");  
        $stmt->bindParam(':idFactura', $idFactura, PDO::PARAM_INT);
        $stmt->execute();
        
        $factura = $stmt->fetch(PDO::FETCH_ASSOC);
        return $factura;  // Devolver solo una factura
    }
}
?>