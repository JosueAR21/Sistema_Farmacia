<?php
class EstadisticasVentas {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerVentasHoy() {
        $query = "EXEC VentasHoy";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerVentasUltimos7Dias() {
        $query = "EXEC VentasUltimos7Dias";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerVentasUltimos30Dias() {
        $query = "EXEC VentasUltimos30Dias";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerVentasUltimos365Dias() {
        $query = "EXEC VentasUltimos365Dias";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtenerVentasPorMes() {
        $query = "EXEC VentasPorMes";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambiado a fetchAll para obtener todos los resultados
    }

    public function obtenerProductosMasVendidos() {
        $query = "EXEC ProductosMasVendidos";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambiado a fetchAll para obtener todos los resultados
    }
    public function obtenerVentasMasRecientes() {
        $query = "EXEC ObtenerVentasRecientes";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambiado a fetchAll para obtener todos los resultados
    }
}
