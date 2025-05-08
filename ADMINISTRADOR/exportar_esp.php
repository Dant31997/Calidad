<?php
// Turn off warnings and notices to prevent output before PDF generation
error_reporting(E_ERROR);
ini_set('display_errors', 0);

require('fpdf.php');

class PDF extends FPDF {
    // Variables para contadores
    private $totalEspacios = 0;
    private $espaciosLibres = 0;
    private $espaciosReservados = 0;
    
    function Header() {
        // Logo (reemplazar con ruta a tu logo si lo tienes)
        // $this->Image('logo.png', 10, 6, 30);
        
        // Título del informe
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode('INFORME DE ESPACIOS'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 6, 'Empresa XYZ', 0, 1, 'C');
        $this->Cell(0, 6, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
        $this->Line(10, $this->GetY() + 3, 200, $this->GetY() + 3);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-20);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(5);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 6, 'Informe generado el ' . date('d/m/Y H:i:s'), 0, 1, 'L');
        $this->Cell(95, 6, 'Contacto: admin@empresaxyz.com', 0, 0, 'L');
        $this->Cell(95, 6, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
    
    function SectionTitle($title) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(0, 8, utf8_decode($title), 0, 1, 'L');
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(2);
    }
    
    function TableHeader() {
        $this->SetFillColor(220, 220, 220);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(50, 8, utf8_decode('Nombre'), 1, 0, 'C', true);
        $this->Cell(70, 8, utf8_decode('Descripción'), 1, 0, 'C', true);
        $this->Cell(30, 8, utf8_decode('Capacidad'), 1, 0, 'C', true);
        $this->Cell(40, 8, utf8_decode('Estado'), 1, 0, 'C', true);
        $this->Ln();
    }
    
    function TableRow($data, $fill = false) {
        $this->SetFont('Arial', '', 10);
        
        // Nombre del espacio
        $this->Cell(50, 7, utf8_decode($data['nom_espacio']), 1, 0, 'L', $fill);
        
        // Descripción (con control de longitud)
        $descripcion = strlen($data['Descripcion']) > 40 ? 
                      substr($data['Descripcion'], 0, 37) . '...' : 
                      $data['Descripcion'];
        $this->Cell(70, 7, utf8_decode($descripcion), 1, 0, 'L', $fill);
        
        // Capacidad (alineada a la derecha por ser número)
        $this->Cell(30, 7, $data['capacidad'], 1, 0, 'R', $fill);
        
        // Estado
        $this->Cell(40, 7, utf8_decode($data['estado_espacio']), 1, 0, 'C', $fill);
        $this->Ln();
    }
    
    // Actualizar contadores
    function actualizarContadores($estado) {
        $this->totalEspacios++;
        if($estado == 'Libre') {
            $this->espaciosLibres++;
        } else if($estado == 'Reservado') {
            $this->espaciosReservados++;
        }
    }
    
    // Getter para contadores
    function getTotalEspacios() { return $this->totalEspacios; }
    function getEspaciosLibres() { return $this->espaciosLibres; }
    function getEspaciosReservados() { return $this->espaciosReservados; }
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");
$conexion->set_charset("utf8"); // Establecer conexión con soporte UTF-8

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Crear un nuevo objeto PDF
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages(); // Para mostrar el total de páginas
$pdf->AddPage();

// Resumen ejecutivo
$pdf->SectionTitle("Resumen Ejecutivo");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode('Este informe presenta un análisis detallado de los espacios disponibles en las instalaciones de la empresa XYZ, clasificándolos por su estado (Libre, Reservado) y proporcionando información sobre su capacidad y características generales.'), 0, 'J');
$pdf->Ln(5);

// Obtener todos los espacios
$sql = "SELECT nom_espacio, Descripcion, capacidad, estado_espacio 
        FROM espacios 
        ORDER BY estado_espacio, nom_espacio";
$resultado = $conexion->query($sql);

// Tabla 1: Todos los espacios
$pdf->SectionTitle("Listado Completo de Espacios");
$pdf->TableHeader();

// Variables para alternar colores y contador
$fill = false;
$counter = 0;

// Almacenar datos para reutilizar
$datosEspacios = [];

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        // Guardar datos para las otras tablas
        $datosEspacios[] = $fila;
        
        // Actualizar contadores
        $pdf->actualizarContadores($fila['estado_espacio']);
        
        // Mostrar fila
        $pdf->TableRow($fila, $fill);
        $fill = !$fill; // Alternar colores
        $counter++;
        
        // Agregar nueva página si es necesario
        if($counter % 25 == 0 && $counter < $resultado->num_rows) {
            $pdf->AddPage();
            $pdf->TableHeader();
        }
    }
} else {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No hay registros de espacios disponibles.', 0, 1);
}

// Agregar página para los espacios Libres
$pdf->AddPage();

// Tabla 2: Espacios Libres
$pdf->SectionTitle("Espacios en Estado Libre");

// Si hay espacios libres, mostrarlos
if ($pdf->getEspaciosLibres() > 0) {
    $pdf->TableHeader();
    $fill = false;
    foreach ($datosEspacios as $fila) {
        if ($fila['estado_espacio'] == 'Libre') {
            $pdf->TableRow($fila, $fill);
            $fill = !$fill;
        }
    }
} else {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No hay espacios en estado Libre.', 0, 1);
}

$pdf->Ln(10);

// Tabla 3: Espacios Reservados
$pdf->SectionTitle("Espacios en Estado Reservado");

// Si hay espacios reservados, mostrarlos
if ($pdf->getEspaciosReservados() > 0) {
    $pdf->TableHeader();
    $fill = false;
    foreach ($datosEspacios as $fila) {
        if ($fila['estado_espacio'] == 'Reservado') {
            $pdf->TableRow($fila, $fill);
            $fill = !$fill;
        }
    }
} else {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No hay espacios en estado Reservado.', 0, 1);
}

// Resumen estadístico
$pdf->AddPage();
$pdf->SectionTitle("Resumen Estadístico");

// Crear tabla de resumen
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(5);

$pdf->SetFillColor(240, 240, 240);
$pdf->Cell(100, 8, 'Total de espacios:', 1, 0, 'L', true);
$pdf->Cell(90, 8, $pdf->getTotalEspacios(), 1, 1, 'R', true);

$pdf->Cell(100, 8, 'Espacios libres:', 1, 0, 'L');
$pdf->Cell(90, 8, $pdf->getEspaciosLibres(), 1, 1, 'R');

$pdf->Cell(100, 8, 'Espacios reservados:', 1, 0, 'L', true);
$pdf->Cell(90, 8, $pdf->getEspaciosReservados(), 1, 1, 'R', true);

if ($pdf->getTotalEspacios() > 0) {
    $pdf->Cell(100, 8, '% de ocupación:', 1, 0, 'L');
    $porcentajeOcupacion = round(($pdf->getEspaciosReservados() / $pdf->getTotalEspacios()) * 100, 1);
    $pdf->Cell(90, 8, $porcentajeOcupacion . '%', 1, 1, 'R');
}

// Conclusiones
$pdf->Ln(10);
$pdf->SectionTitle("Conclusión");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode('Este informe proporciona una visión general de los espacios disponibles en la empresa. La gestión eficiente de estos recursos es fundamental para optimizar las operaciones y garantizar su disponibilidad cuando sea necesario. Se recomienda revisar periódicamente el estado de los espacios para maximizar su utilización.'), 0, 'J');

// Cerrar la conexión a la base de datos
$conexion->close();

// Generar el archivo PDF
$pdf->Output('Informe_Espacios_' . date('Y-m-d') . '.pdf', 'I');
?>