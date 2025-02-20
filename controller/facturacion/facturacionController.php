<?php
// Incluir archivos de conexión y modelo
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/bd/config/conexion.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/model/Facturacion/facturacionModel.php');
require($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/lib/tcpdf/tcpdf.php'); // Asegúrate de tener TCPDF correctamente instalado

$database = new Database();
$pdo = $database->getConnection();
$facturacionController = new FacturaController($pdo);  // Instanciar solo el controlador
$facturas = $facturacionController->obtenerTodasLasFacturas();
$model = new facturacionModel($pdo);

if (isset($_GET['action']) && $_GET['action'] == 'generarPDF' && isset($_GET['idFactura'])) {
    $idFactura = $_GET['idFactura'];  // Captura el idFactura desde la URL
    echo 'ID Factura: ' . $idFactura;  // Depuración: Verifica si se recibe el idFactura
    $facturacionController->generarPDF($idFactura);  // Llamar a la función generarPDF con el idFactura
    exit;  // Asegúrate de detener la ejecución después de generar el PDF
}


class FacturaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new FacturacionModel($pdo);  // Pasar la conexión PDO al modelo
    }

    // Método para obtener todas las facturas (para la tabla)
    public function obtenerTodasLasFacturas() {
        return $this->model->VisualizarFacturacion();
    }

    public function obtenerFacturaVenta($idFactura) {
        return $this->model->obtenerFacturaVenta($idFactura);
    }

    public function generarPDF($idFactura) {
        // Evitar salida previa
        ob_start(); // Iniciar el buffer de salida
    
        // Obtener los datos de la factura desde el modelo
        $facturaVenta = $this->model->obtenerFacturaVenta($idFactura);
    
        if (!$facturaVenta) {
            die('No se encontraron datos para la factura.');
        }
    
        // Crear una instancia de TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Factura Venta');
        $pdf->SetHeaderData('', 0, 'Factura Venta', 'Detalles de la factura');
        $pdf->setHeaderFont(['helvetica', '', 10]);
        $pdf->setFooterFont(['helvetica', '', 8]);
        $pdf->SetMargins(15, 27, 15);
        $pdf->AddPage();
    
        // Contenido HTML del PDF
        $html = '
            <style>
                body {
                    font-family: Helvetica, sans-serif;
                }
                .header {
                    text-align: center;
                    background-color: #f0f0f0;
                    padding: 20px;
                    border-bottom: 2px solid #003366;
                }
                .header h1 {
                    margin: 0;
                    color: #003366;
                }
                .factura-info {
                    border: 1px solid #cccccc;
                    padding: 15px;
                    margin: 20px;
                    background-color: #ffffff;
                }
                .factura-info h2 {
                    color: #003366;
                    border-bottom: 1px solid #cccccc;
                    padding-bottom: 10px;
                }
                .factura-info p {
                    font-size: 12pt;
                    margin: 5px 0;
                }
                .label {
                    font-weight: bold;
                    color: #003366;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 10pt;
                    color: #888888;
                }
            </style>

            <div class="header">
                <h1>Factura de Venta</h1>
            </div>

            <div class="factura-info">
                <h2>Detalles de la Factura</h2>
                <p><span class="label">ID Factura:</span> ' . htmlspecialchars($facturaVenta['Id_factura']) . '</p>
                <p><span class="label">Nombre Cliente:</span> ' . htmlspecialchars($facturaVenta['Nombre_Cliente']) . '</p>
                <p><span class="label">Producto:</span> ' . htmlspecialchars($facturaVenta['Producto']) . '</p>
                <p><span class="label">Cantidad:</span> ' . htmlspecialchars($facturaVenta['Cantidad']) . '</p>
                <p><span class="label">Nombre Empleado:</span> ' . htmlspecialchars($facturaVenta['Nombre_Empleado']) . '</p>
                <p><span class="label">Fecha Emisión:</span> ' . htmlspecialchars($facturaVenta['Fecha_Emision']) . '</p>
                <p><span class="label">Monto Total:</span> $' . htmlspecialchars(number_format($facturaVenta['Monto_Total'], 2)) . '</p>
            </div>

            <div class="footer">
                <p>Gracias por su compra!</p>
                <p>Para más información, contacte con nosotros.</p>
            </div>
            ';

            // Escribir el HTML al PDF
            $pdf->writeHTML($html, true, false, true, false, '');
    
        // Mostrar el PDF en el navegador en una nueva pestaña
        $pdf->Output('Factura_Venta_' . $facturaVenta['Id_factura'] . '.pdf', 'I');  // 'I' para abrir el PDF en el navegador
    
        exit();  // Asegurarse de que el código no continúe después de la salida del PDF
    }
}

?>
