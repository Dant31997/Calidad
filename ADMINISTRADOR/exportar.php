<?php
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 10, 'ID', 1);
        $this->Cell(60, 10, 'Nombre de Usuario', 1);
        $this->Cell(60, 10, 'Rol', 1);
        $this->Cell(65, 10, 'Nombre', 1);
        $this->Cell(60, 10, 'Contrasena', 1);
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
$sql = "SELECT id, nombre_usuario, contrasena, nombre, rol FROM usuarios";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, $fila['id'], 1);
        $pdf->Cell(60, 10, $fila['nombre_usuario'], 1);
        $pdf->Cell(60, 10, $fila['rol'], 1);
        $pdf->Cell(65, 10, $fila['nombre'], 1);
        $pdf->Cell(60, 10, $fila['contrasena'], 1);
        $pdf->Ln();
    }
} else {
    echo "No hay registros para exportar.";
}

// Generar el archivo PDF
$pdf->Output();
?>
