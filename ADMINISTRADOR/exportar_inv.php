<?php
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 10, 'codigo', 1);
        $this->Cell(60, 10, 'Nombre de Inventario', 1);
        $this->Cell(40, 10, 'Estado del activo', 1);
        $this->Cell(65, 10, 'Nombre de la persona', 1);
        $this->Cell(45, 10, 'Dia del prestamo', 1);
        $this->Cell(45, 10, 'Estado del prestamo', 1);
        $this->Ln();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AddPage();

// Consulta SQL para obtener datos de la tabla inventario.
$sql = "SELECT cod_inventario, nom_inventario, estado, nombre_persona, diahora_p, devolucion FROM inventario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(20, 10, $fila['cod_inventario'], 1);
        $pdf->Cell(60, 10, $fila['nom_inventario'], 1);
        $pdf->Cell(40, 10, $fila['estado'], 1);
        $pdf->Cell(65, 10, $fila['nombre_persona'], 1);
        $pdf->Cell(45, 10, $fila['diahora_p'], 1);
        $pdf->Cell(45, 10, $fila['devolucion'], 1);
        $pdf->Ln();
    }
} else {
    echo "No hay registros para exportar.";
}

// Generar el archivo PDF
$pdf->Output();
?>
