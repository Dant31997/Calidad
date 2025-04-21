<?php
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 10, 'Codigo', 1);
        $this->Cell(60, 10, 'Nombre del Espacio', 1);
        $this->Cell(30, 10, 'Estado', 1);
        $this->Cell(65, 10, 'Nombre', 1);
        $this->Cell(45, 10, 'Dia que se necesita', 1);
        $this->Cell(50, 10, 'Horario de uso', 1);
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

// Consulta SQL para obtener datos de la tabla usuarios
$sql = "SELECT cod_espacio, nom_espacio, estado_espacio, persona_encargada, dh_espacio, dh_regreso FROM espacios";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(20, 10, $fila['cod_espacio'], 1);
        $pdf->Cell(60, 10, $fila['nom_espacio'], 1);
        $pdf->Cell(30, 10, $fila['estado_espacio'], 1);
        $pdf->Cell(65, 10, $fila['persona_encargada'], 1);
        $pdf->Cell(45, 10, $fila['dh_espacio'], 1);
        $pdf->Cell(50, 10, $fila['dh_regreso'], 1);
        $pdf->Ln();
    }
} else {
    echo "No hay registros para exportar.";
}

// Generar el archivo PDF
$pdf->Output();
?>
