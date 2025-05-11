<?php
// Desactivar advertencias para evitar interferencia con la salida del PDF
error_reporting(E_ERROR | E_PARSE);

require('fpdf.php');

class PDF extends FPDF {
    // Colores para las secciones
    public $colorSinRevisar = [254, 240, 202]; // Amarillo claro
    public $colorAprobada = [204, 255, 204];   // Verde claro
    public $colorRechazada = [255, 204, 204];  // Rojo claro
    
    // Variables para estadísticas
    public $totalPeticiones = 0;
    public $totalSinRevisar = 0;
    public $totalAprobadas = 0;
    public $totalRechazadas = 0;
    
    // Variables para porcentajes
    private $porcentajeSinRevisar = 0;
    private $porcentajeAprobadas = 0;
    private $porcentajeRechazadas = 0;
    
    // Función para convertir cadenas UTF-8 (reemplaza utf8_decode)
    public function convertirUTF8($texto) {
        return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texto);
    }
    
    function Header() {
        // Logo (opcional)
        // $this->Image('logo.png', 10, 6, 30);
        
        // Título del informe
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, $this->convertirUTF8('INFORME DE PETICIONES DE INSUMOS'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 6, 'Fecha de generacion: ' . date('d/m/Y'), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertirUTF8('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    
    // Función para títulos de sección
    function SectionTitle($title, $color) {
        $this->SetFillColor($color[0], $color[1], $color[2]);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $this->convertirUTF8($title), 1, 1, 'L', true);
    }
    
    // Función para encabezados de tabla
    function TableHeader() {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(220, 220, 220);
        $this->Cell(20, 7, $this->convertirUTF8('ID'), 1, 0, 'C', true);
        $this->Cell(50, 7, $this->convertirUTF8('Insumo necesario'), 1, 0, 'C', true);
        $this->Cell(15, 7, 'Cant.', 1, 0, 'C', true);
        $this->Cell(40, 7, $this->convertirUTF8('Solicitante'), 1, 0, 'C', true);
        $this->Cell(25, 7, 'Estado', 1, 0, 'C', true);
        $this->Cell(25, 7, $this->convertirUTF8('Día entrega'), 1, 0, 'C', true);
        $this->Cell(20, 7, 'H. recoge', 1, 0, 'C', true);
        $this->Cell(20, 7, 'H. devuelve', 1, 0, 'C', true);
        $this->Ln();
    }
    
    // Función para calcular porcentajes
    function calcularPorcentajes() {
        $this->porcentajeSinRevisar = ($this->totalPeticiones > 0) ? 
            ($this->totalSinRevisar / $this->totalPeticiones) * 100 : 0;
            
        $this->porcentajeAprobadas = ($this->totalPeticiones > 0) ? 
            ($this->totalAprobadas / $this->totalPeticiones) * 100 : 0;
            
        $this->porcentajeRechazadas = ($this->totalPeticiones > 0) ? 
            ($this->totalRechazadas / $this->totalPeticiones) * 100 : 0;
    }
    
    // Función para agregar estadísticas
    function addStatistics() {
        // Calcular porcentajes primero
        $this->calcularPorcentajes();
        
        $this->AddPage();
        
        // Título de la sección
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, $this->convertirUTF8('ESTADÍSTICAS DE PETICIONES'), 0, 1, 'C');
        $this->Ln(5);
        
        // Tabla de estadísticas
        $this->SetFillColor(220, 220, 220);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(100, 8, 'Estado', 1, 0, 'C', true);
        $this->Cell(45, 8, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(45, 8, 'Porcentaje', 1, 1, 'C', true);
        
        $this->SetFont('Arial', '', 11);
        
        // Sin Revisar
        $this->SetFillColor($this->colorSinRevisar[0], $this->colorSinRevisar[1], $this->colorSinRevisar[2]);
        $this->Cell(100, 8, 'Sin Revisar', 1, 0, 'L', true);
        $this->Cell(45, 8, $this->totalSinRevisar, 1, 0, 'C', true);
        $this->Cell(45, 8, number_format($this->porcentajeSinRevisar, 2) . '%', 1, 1, 'C', true);
        
        // Aprobadas
        $this->SetFillColor($this->colorAprobada[0], $this->colorAprobada[1], $this->colorAprobada[2]);
        $this->Cell(100, 8, 'Aprobadas', 1, 0, 'L', true);
        $this->Cell(45, 8, $this->totalAprobadas, 1, 0, 'C', true);
        $this->Cell(45, 8, number_format($this->porcentajeAprobadas, 2) . '%', 1, 1, 'C', true);
        
        // Rechazadas
        $this->SetFillColor($this->colorRechazada[0], $this->colorRechazada[1], $this->colorRechazada[2]);
        $this->Cell(100, 8, 'Rechazadas', 1, 0, 'L', true);
        $this->Cell(45, 8, $this->totalRechazadas, 1, 0, 'C', true);
        $this->Cell(45, 8, number_format($this->porcentajeRechazadas, 2) . '%', 1, 1, 'C', true);
        
        // Total
        $this->SetFillColor(220, 220, 220);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(100, 8, 'TOTAL', 1, 0, 'L', true);
        $this->Cell(45, 8, $this->totalPeticiones, 1, 0, 'C', true);
        $this->Cell(45, 8, '100.00%', 1, 1, 'C', true);
        
        $this->Ln(15);
        
        // Gráfico simple de barras
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, $this->convertirUTF8('Representación gráfica:'), 0, 1);
        
        $maxBarWidth = 150;
        $barHeight = 15;
        $startX = 30;
        $startY = $this->GetY() + 5;
        
        // Sin Revisar
        $this->SetFillColor($this->colorSinRevisar[0], $this->colorSinRevisar[1], $this->colorSinRevisar[2]);
        $barWidth = ($this->porcentajeSinRevisar / 100) * $maxBarWidth;
        $this->Rect($startX, $startY, $barWidth, $barHeight, 'F');
        $this->SetXY($startX + $barWidth + 5, $startY + 2);
        $this->Cell(50, 10, 'Sin Revisar: ' . number_format($this->porcentajeSinRevisar, 2) . '%', 0, 1);
        
        // Aprobadas
        $this->SetFillColor($this->colorAprobada[0], $this->colorAprobada[1], $this->colorAprobada[2]);
        $barWidth = ($this->porcentajeAprobadas / 100) * $maxBarWidth;
        $this->Rect($startX, $startY + $barHeight + 5, $barWidth, $barHeight, 'F');
        $this->SetXY($startX + $barWidth + 5, $startY + $barHeight + 7);
        $this->Cell(50, 10, 'Aprobadas: ' . number_format($this->porcentajeAprobadas, 2) . '%', 0, 1);
        
        // Rechazadas
        $this->SetFillColor($this->colorRechazada[0], $this->colorRechazada[1], $this->colorRechazada[2]);
        $barWidth = ($this->porcentajeRechazadas / 100) * $maxBarWidth;
        $this->Rect($startX, $startY + $barHeight * 2 + 10, $barWidth, $barHeight, 'F');
        $this->SetXY($startX + $barWidth + 5, $startY + $barHeight * 2 + 12);
        $this->Cell(50, 10, 'Rechazadas: ' . number_format($this->porcentajeRechazadas, 2) . '%', 0, 1);
    }
    
    // Función para añadir conclusiones
    function addConclusions() {
        $this->AddPage();
        
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, $this->convertirUTF8('CONCLUSIONES Y RECOMENDACIONES'), 0, 1, 'C');
        $this->Ln(5);
        
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, $this->convertirUTF8('Análisis de las Peticiones:'), 0, 1);
        $this->SetFont('Arial', '', 11);
        
        // Calculamos la tasa de aprobación
        $tasaAprobacion = ($this->totalAprobadas + $this->totalRechazadas > 0) ? 
            ($this->totalAprobadas / ($this->totalAprobadas + $this->totalRechazadas)) * 100 : 0;
        
        // Texto con conclusiones basadas en los datos
        $text = "• Un " . number_format($this->porcentajeSinRevisar, 2) . "% de las peticiones se encuentran sin revisar. ";
        
        if ($this->porcentajeSinRevisar > 30) {
            $text .= "Se recomienda agilizar el proceso de revisión para mejorar los tiempos de respuesta.";
        } else {
            $text .= "El nivel de peticiones pendientes se encuentra dentro de parámetros aceptables.";
        }
        $this->MultiCell(0, 6, $this->convertirUTF8($text), 0, 'J');
        $this->Ln(3);
        
        $text = "• La tasa de aprobación de peticiones es del " . number_format($tasaAprobacion, 2) . "%. ";
        if ($tasaAprobacion < 50) {
            $text .= "Este porcentaje es bajo y puede indicar una falta de disponibilidad de insumos o criterios muy estrictos para la aprobación.";
        } elseif ($tasaAprobacion > 90) {
            $text .= "Este porcentaje es muy alto y podría ser necesario revisar los criterios de aprobación para garantizar un uso eficiente de los recursos.";
        } else {
            $text .= "Este porcentaje se encuentra en un rango adecuado, reflejando un balance entre disponibilidad y control de recursos.";
        }
        $this->MultiCell(0, 6, $this->convertirUTF8($text), 0, 'J');
        $this->Ln(3);
        
        // Recomendaciones generales
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, $this->convertirUTF8('Recomendaciones:'), 0, 1);
        $this->SetFont('Arial', '', 11);
        
        $recomendaciones = [
            "Establecer tiempos máximos de respuesta para las peticiones pendientes.",
            "Implementar un sistema de notificación automática para peticiones que llevan más de 48 horas sin revisar.",
            "Realizar un análisis mensual de los insumos más solicitados para anticipar necesidades.",
            "Revisar los criterios de aprobación/rechazo para mantener un balance adecuado.",
            "Considerar la implementación de un calendario de disponibilidad de insumos visible para todos los usuarios."
        ];
        
        foreach ($recomendaciones as $recomendacion) {
            $this->MultiCell(0, 6, $this->convertirUTF8("• " . $recomendacion), 0, 'J');
            $this->Ln(2);
        }
    }
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");
$conexion->set_charset("utf8"); // Establecer conexión con soporte UTF-8

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Para mostrar el número total de páginas
$pdf->SetMargins(10, 10, 10); // Márgenes
$pdf->AddPage();

// Contar totales para estadísticas
$sqlTotales = "SELECT estado_peticion, COUNT(*) as total FROM peticiones_insumos GROUP BY estado_peticion";
$resultadoTotales = $conexion->query($sqlTotales);
while ($fila = $resultadoTotales->fetch_assoc()) {
    switch ($fila['estado_peticion']) {
        case 'Sin Revisar':
            $pdf->totalSinRevisar = $fila['total'];
            break;
        case 'Aprobada':
            $pdf->totalAprobadas = $fila['total'];
            break;
        case 'Rechazada':
            $pdf->totalRechazadas = $fila['total'];
            break;
    }
}
$pdf->totalPeticiones = $pdf->totalSinRevisar + $pdf->totalAprobadas + $pdf->totalRechazadas;

// Sección 1: Peticiones Sin Revisar
$pdf->SectionTitle('PETICIONES SIN REVISAR', $pdf->colorSinRevisar);
$pdf->TableHeader();

$sql = "SELECT Id, equipo, cantidad, nom_persona, estado_peticion, dia_entrega, hora_entrega, hora_regreso 
        FROM peticiones_insumos 
        WHERE estado_peticion = 'Sin Revisar' 
        ORDER BY Id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $pdf->SetFont('Arial', '', 9);
    $fill = false;
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(20, 7, $fila['Id'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 7, $pdf->convertirUTF8($fila['equipo']), 1, 0, 'L', $fill);
        $pdf->Cell(15, 7, $fila['cantidad'], 1, 0, 'C', $fill);
        $pdf->Cell(40, 7, $pdf->convertirUTF8($fila['nom_persona']), 1, 0, 'L', $fill);
        $pdf->Cell(25, 7, $pdf->convertirUTF8($fila['estado_peticion']), 1, 0, 'C', $fill);
        $pdf->Cell(25, 7, $fila['dia_entrega'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 7, $fila['hora_entrega'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 7, $fila['hora_regreso'], 1, 0, 'C', $fill);
        $pdf->Ln();
        $fill = !$fill;
        
        // Si llegamos al final de la página, añadir encabezado
        if ($pdf->GetY() > 250) {
            $pdf->AddPage();
            $pdf->SectionTitle('PETICIONES SIN REVISAR (continuación)', $pdf->colorSinRevisar);
            $pdf->TableHeader();
        }
    }
} else {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No hay peticiones sin revisar', 1, 1, 'C');
}

$pdf->Ln(10);

// Sección 2: Peticiones Aprobadas
$pdf->AddPage();
$pdf->SectionTitle('PETICIONES APROBADAS', $pdf->colorAprobada);
$pdf->TableHeader();

$sql = "SELECT Id, equipo, cantidad, nom_persona, estado_peticion, dia_entrega, hora_entrega, hora_regreso 
        FROM peticiones_insumos 
        WHERE estado_peticion = 'Aprobada' 
        ORDER BY Id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $pdf->SetFont('Arial', '', 9);
    $fill = false;
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(20, 7, $fila['Id'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 7, $pdf->convertirUTF8($fila['equipo']), 1, 0, 'L', $fill);
        $pdf->Cell(15, 7, $fila['cantidad'], 1, 0, 'C', $fill);
        $pdf->Cell(40, 7, $pdf->convertirUTF8($fila['nom_persona']), 1, 0, 'L', $fill);
        $pdf->Cell(25, 7, $pdf->convertirUTF8($fila['estado_peticion']), 1, 0, 'C', $fill);
        $pdf->Cell(25, 7, $fila['dia_entrega'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 7, $fila['hora_entrega'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 7, $fila['hora_regreso'], 1, 0, 'C', $fill);
        $pdf->Ln();
        $fill = !$fill;
        
        // Si llegamos al final de la página, añadir encabezado
        if ($pdf->GetY() > 250) {
            $pdf->AddPage();
            $pdf->SectionTitle('PETICIONES APROBADAS (continuación)', $pdf->colorAprobada);
            $pdf->TableHeader();
        }
    }
} else {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No hay peticiones aprobadas', 1, 1, 'C');
}

$pdf->Ln(10);

// Sección 3: Peticiones Rechazadas
$pdf->AddPage();
$pdf->SectionTitle('PETICIONES RECHAZADAS', $pdf->colorRechazada);
$pdf->TableHeader();

$sql = "SELECT Id, equipo, cantidad, nom_persona, estado_peticion, dia_entrega, hora_entrega, hora_regreso 
        FROM peticiones_insumos 
        WHERE estado_peticion = 'Rechazada' 
        ORDER BY Id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $pdf->SetFont('Arial', '', 9);
    $fill = false;
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(20, 7, $fila['Id'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 7, $pdf->convertirUTF8($fila['equipo']), 1, 0, 'L', $fill);
        $pdf->Cell(15, 7, $fila['cantidad'], 1, 0, 'C', $fill);
        $pdf->Cell(40, 7, $pdf->convertirUTF8($fila['nom_persona']), 1, 0, 'L', $fill);
        $pdf->Cell(25, 7, $pdf->convertirUTF8($fila['estado_peticion']), 1, 0, 'C', $fill);
        $pdf->Cell(25, 7, $fila['dia_entrega'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 7, $fila['hora_entrega'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 7, $fila['hora_regreso'], 1, 0, 'C', $fill);
        $pdf->Ln();
        $fill = !$fill;
        
        // Si llegamos al final de la página, añadir encabezado
        if ($pdf->GetY() > 250) {
            $pdf->AddPage();
            $pdf->SectionTitle('PETICIONES RECHAZADAS (continuación)', $pdf->colorRechazada);
            $pdf->TableHeader();
        }
    }
} else {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No hay peticiones rechazadas', 1, 1, 'C');
}

// Agregar estadísticas y gráficos
$pdf->addStatistics();

// Agregar conclusiones
$pdf->addConclusions();

// Generar el archivo PDF
$pdf->Output('Informe_Peticiones_Insumos.pdf', 'I');

// Cerrar conexión
$conexion->close();
?>