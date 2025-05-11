<?php
ob_start();
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 12, $this->codificar('INFORME DE PRÉSTAMOS DE INSUMOS Y ESPACIOS'), 0, 1, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 8, 'Fecha de generación: ' . date('d/m/Y'), 0, 1, 'R');
        $this->Ln(3);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function codificar($texto) {
        return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
    }
    function addSectionTitle($title) {
        $this->SetFont('Arial', 'B', 13);
        $this->SetFillColor(220, 220, 220);
        $this->Cell(0, 10, $this->codificar($title), 0, 1, 'L', true);
        $this->Ln(2);
    }
    function addExplanation($title, $text) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, $this->codificar($title), 0, 1);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 6, $this->codificar($text));
        $this->Ln(4);
    }
    function tablaPrestamosInsumos($header, $data) {
        $this->SetFont('Arial', 'B', 11);
        $w = [15, 35, 18, 40, 20, 22, 18, 18, 25];
        for($i=0; $i<count($header); $i++)
            $this->Cell($w[$i], 7, $this->codificar($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 9);
        foreach($data as $row) {
            for($i=0; $i<count($header); $i++)
                $this->Cell($w[$i], 6, $this->codificar($row[$i]), 1);
            $this->Ln();
        }
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(array_sum($w), 7, 'Total de registros: ' . count($data), 1, 0, 'R');
        $this->Ln(10);
    }
    function tablaPrestamosEspacios($header, $data) {
        $this->SetFont('Arial', 'B', 11);
        $w = [18, 35, 40, 18, 22, 18, 18, 25, 25];
        for($i=0; $i<count($header); $i++)
            $this->Cell($w[$i], 7, $this->codificar($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 9);
        foreach($data as $row) {
            for($i=0; $i<count($header); $i++)
                $this->Cell($w[$i], 6, $this->codificar($row[$i]), 1);
            $this->Ln();
        }
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(array_sum($w), 7, 'Total de registros: ' . count($data), 1, 0, 'R');
        $this->Ln(10);
    }
}

error_reporting(0);
$conexion = new mysqli("localhost", "root", "", "basededatos");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4');
$pdf->SetAutoPageBreak(true, 15);

// Introducción
$pdf->addExplanation('RESUMEN EJECUTIVO',
    "Este informe presenta un análisis detallado de los préstamos de insumos y espacios realizados en la empresa. " .
    "Se incluyen tablas con los registros, cálculos de totales y porcentajes, así como observaciones y recomendaciones para la mejora de la gestión de recursos."
);

// ==================== PRÉSTAMOS DE INSUMOS ====================
$pdf->addSectionTitle('PRÉSTAMOS DE INSUMOS');

// Consulta y carga de datos
$sql = "SELECT id_prestamo, insumo, cantidad, nombre_persona_prestamo, estado, dia_prestamo, desde, hasta, fecha_devolucion FROM prestamos_insumos";
$res = $conexion->query($sql);
$data_insumos = [];
$estados_insumos = ['Pendiente'=>0, 'Devuelto'=>0, 'Vencido'=>0];
if ($res && $res->num_rows > 0) {
    while ($f = $res->fetch_assoc()) {
        $estado = $f['estado'];
        if ($estado == 0) $estados_insumos['Pendiente']++;
        elseif ($estado == 1) $estados_insumos['Devuelto']++;
        elseif ($estado == 2) $estados_insumos['Vencido']++;
        $data_insumos[] = [
            $f['id_prestamo'],
            $f['insumo'],
            $f['cantidad'],
            $f['nombre_persona_prestamo'],
            ($estado == 0 ? 'Pendiente' : ($estado == 1 ? 'Devuelto' : 'Vencido')),
            $f['dia_prestamo'],
            $f['desde'],
            $f['hasta'],
            $f['fecha_devolucion']
        ];
    }
}
$header_insumos = ['ID', 'Insumo', 'Cantidad', 'Persona', 'Estado', 'Día', 'Desde', 'Hasta', 'Devolución'];
$pdf->tablaPrestamosInsumos($header_insumos, $data_insumos);

// Estadísticas de insumos
$total_insumos = count($data_insumos);
$porc_pend = $total_insumos ? round($estados_insumos['Pendiente']*100/$total_insumos,2) : 0;
$porc_dev = $total_insumos ? round($estados_insumos['Devuelto']*100/$total_insumos,2) : 0;
$porc_venc = $total_insumos ? round($estados_insumos['Vencido']*100/$total_insumos,2) : 0;

$pdf->addExplanation('ANÁLISIS DE PRÉSTAMOS DE INSUMOS',
    "Total de préstamos de insumos: $total_insumos\n" .
    "• Pendientes: {$estados_insumos['Pendiente']} ($porc_pend%)\n" .
    "• Devueltos: {$estados_insumos['Devuelto']} ($porc_dev%)\n" .
    "• Vencidos: {$estados_insumos['Vencido']} ($porc_venc%)\n\n" .
    "Se recomienda dar seguimiento a los préstamos pendientes y vencidos para evitar pérdidas o retrasos en la devolución de insumos."
);

// ==================== PRÉSTAMOS DE ESPACIOS ====================
$pdf->addSectionTitle('PRÉSTAMOS DE ESPACIOS');

$sql = "SELECT id_prestamo_espacio, espacio, nom_persona, estado, dia_prestamo, fecha_entrega, desde, hasta, fecha_devolucion FROM prestamos_espacios";
$res = $conexion->query($sql);
$data_espacios = [];
$estados_espacios = ['Pendiente'=>0, 'Devuelto'=>0, 'Vencido'=>0];
if ($res && $res->num_rows > 0) {
    while ($f = $res->fetch_assoc()) {
        $estado = $f['estado'];
        if ($estado == 0) $estados_espacios['Pendiente']++;
        elseif ($estado == 1) $estados_espacios['Devuelto']++;
        elseif ($estado == 2) $estados_espacios['Vencido']++;
        $data_espacios[] = [
            $f['id_prestamo_espacio'],
            $f['espacio'],
            $f['nom_persona'],
            ($estado == 0 ? 'Pendiente' : ($estado == 1 ? 'Devuelto' : 'Vencido')),
            $f['dia_prestamo'],
            $f['fecha_entrega'],
            $f['desde'],
            $f['hasta'],
            $f['fecha_devolucion']
        ];
    }
}
$header_espacios = ['ID', 'Espacio', 'Persona', 'Estado', 'Día', 'Entrega', 'Desde', 'Hasta', 'Devolución'];
$pdf->tablaPrestamosEspacios($header_espacios, $data_espacios);

// Estadísticas de espacios
$total_espacios = count($data_espacios);
$porc_pend_e = $total_espacios ? round($estados_espacios['Pendiente']*100/$total_espacios,2) : 0;
$porc_dev_e = $total_espacios ? round($estados_espacios['Devuelto']*100/$total_espacios,2) : 0;
$porc_venc_e = $total_espacios ? round($estados_espacios['Vencido']*100/$total_espacios,2) : 0;

$pdf->addExplanation('ANÁLISIS DE PRÉSTAMOS DE ESPACIOS',
    "Total de préstamos de espacios: $total_espacios\n" .
    "• Pendientes: {$estados_espacios['Pendiente']} ($porc_pend_e%)\n" .
    "• Devueltos: {$estados_espacios['Devuelto']} ($porc_dev_e%)\n" .
    "• Vencidos: {$estados_espacios['Vencido']} ($porc_venc_e%)\n\n" .
    "Es importante asegurar la devolución oportuna de los espacios y mantener registros claros para optimizar su uso."
);

// ==================== CONCLUSIONES Y RECOMENDACIONES ====================
$pdf->addSectionTitle('CONCLUSIONES Y RECOMENDACIONES');
$pdf->addExplanation('Resumen Final',
    "• Total de préstamos de insumos: $total_insumos\n" .
    "• Total de préstamos de espacios: $total_espacios\n\n" .
    "Recomendaciones:\n" .
    "1. Realizar auditorías periódicas de los préstamos pendientes y vencidos.\n" .
    "2. Implementar recordatorios automáticos para devoluciones próximas.\n" .
    "3. Optimizar la gestión de insumos y espacios para reducir retrasos y mejorar la disponibilidad.\n" .
    "4. Mantener comunicación constante con los responsables de los préstamos para asegurar el cumplimiento de las políticas internas."
);

$conexion->close();
ob_end_clean();
$pdf->Output('Informe_Prestamos.pdf', 'I');
?>