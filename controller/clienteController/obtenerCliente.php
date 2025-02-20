<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');

$database = new Database();
$conn = $database->getConnection(); // Obtener la conexión

// Inicializar la variable $clientes
$clientes = []; 

try {
    // Preparar la llamada al procedimiento almacenado
    $sql = "{call ObtenerClientes()}"; // Llama a tu procedimiento almacenado
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode(array("status" => "error", "message" => "Error al obtener los clientes: " . $e->getMessage()));
}


$conn = null;
?>
