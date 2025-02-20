<?php
class Database {
    private $serverName = "LAPTOP-3I4EH1R2"; // Nombre de tu servidor
    private $database = "Farmacia1"; // Nombre de tu base de datos
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            // Establecer la conexión usando PDO y autenticación de Windows
            $this->conn = new PDO("sqlsrv:server=$this->serverName;Database=$this->database", null, null, [
                PDO::SQLSRV_ATTR_DIRECT_QUERY => true,
            ]);
            // Configurar el modo de errores
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Mensaje de conexión exitosa (puedes comentarlo en producción)
            // echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $e) {
            // En caso de error, puedes manejarlo aquí si es necesario
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn; // Retorna la conexión
    }
}
?>
