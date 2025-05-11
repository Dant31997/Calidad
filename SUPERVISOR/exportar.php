<?php
// Activar buffer de salida para evitar envío de datos antes del PDF
ob_start();

require('fpdf.php');

class PDF extends FPDF {
    // Cabecera de página con título y fecha
    function Header() {
        // Logo o imagen corporativa (opcional)
        // $this->Image('logo.png', 10, 8, 33);
        
        // Título del informe
        $this->SetFont('Arial', 'B', 18);
       $this->Cell(0, 15, $this->codificar('INFORME DE GESTIÓN DE USUARIOS'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $this->Ln(5);
    }
    
    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    
    // Función para crear una tabla general
    function crearTablaGeneral($header, $data) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(0, 10, 'LISTADO GENERAL DE USUARIOS', 0, 1, 'C');
        $this->Ln(2);
        
        // Encabezado de la tabla
        $this->SetFont('Arial', 'B', 11);
        $w = array(70, 70, 50);
        for($i=0; $i<count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        
        // Datos de la tabla - Reemplazar utf8_decode con mb_convert_encoding
        $this->SetFont('Arial', '', 10);
        foreach($data as $row) {
            $this->Cell($w[0], 6, $this->codificar($row[0]), 1);
            $this->Cell($w[1], 6, $this->codificar($row[1]), 1);
            $this->Cell($w[2], 6, $this->codificar($row[2]), 1);
            $this->Ln();
        }
        
        // Total de registros
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(array_sum($w), 7, 'Total de registros: ' . count($data), 1, 0, 'R');
        $this->Ln(15);
    }
    
    // Función para crear tabla de usuarios por estado
    function crearTablaEstado($header, $data, $titulo, $color) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor($color[0], $color[1], $color[2]);
        $this->Cell(0, 10, $titulo, 0, 1, 'C');
        $this->Ln(2);
        
        // Encabezado de la tabla
        $this->SetFont('Arial', 'B', 11);
        $w = array(20, 70, 100);
        for($i=0; $i<count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        
        // Datos de la tabla - Reemplazar utf8_decode con mb_convert_encoding
        $this->SetFont('Arial', '', 10);
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 1);
            $this->Cell($w[1], 6, $this->codificar($row[1]), 1);
            $this->Cell($w[2], 6, $this->codificar($row[2]), 1);
            $this->Ln();
        }
        
        // Total de registros
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(array_sum($w), 7, 'Total de registros: ' . count($data), 1, 0, 'R');
        $this->Ln(15);
    }
    
    // Función para añadir texto explicativo
    function addExplanation($title, $text) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, $this->codificar($title), 0, 1);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 6, $this->codificar($text));
        $this->Ln(5);
    }
    
    // Función para manejar la codificación de texto
    function codificar($texto) {
        // Alternativa a utf8_decode que está depreciada desde PHP 8.2
        return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
    }
}

// Desactivar notificaciones para evitar cualquier salida no deseada
error_reporting(0);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Para mostrar el total de páginas
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 15);

// Añadir una introducción
$pdf->addExplanation('RESUMEN EJECUTIVO', 
    'Este informe presenta un análisis completo del sistema de usuarios registrados. '.
    'Se detallan tres secciones principales: un listado general de usuarios, '.
    'usuarios activos y usuarios inactivos. Este documento ayudará a la gestión '.
    'efectiva del personal y control de accesos al sistema.');

// Consulta para tabla general
$sql = "SELECT nombre_usuario, nombre, rol FROM usuarios";
$resultado = $conexion->query($sql);

$data = array();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = array($fila['nombre_usuario'], $fila['nombre'], $fila['rol']);
    }
}

// Crear tabla general
$header = array('Nombre de Usuario', 'Nombre de la Persona', 'Rol');
$pdf->crearTablaGeneral($header, $data);

// Explicación de la primera tabla
$pdf->addExplanation('ANÁLISIS GENERAL', 
    'La tabla anterior muestra todos los usuarios registrados en el sistema con sus roles correspondientes. '.
    'Esto permite una visión global de todos los usuarios que tienen acceso al sistema, '.
    'independientemente de su estado actual.');

// Consulta para usuarios activos (estado = 1)
$sql_activos = "SELECT id, nombre_usuario, nombre FROM usuarios WHERE estado = 1";
$resultado_activos = $conexion->query($sql_activos);

$data_activos = array();
if ($resultado_activos->num_rows > 0) {
    while ($fila = $resultado_activos->fetch_assoc()) {
        $data_activos[] = array($fila['id'], $fila['nombre_usuario'], $fila['nombre']);
    }
}

// Crear tabla de usuarios activos
$header_activos = array('ID', 'Usuario', 'Nombre');
$pdf->crearTablaEstado($header_activos, $data_activos, 'TABLA DE USUARIOS ACTIVOS', array(150, 230, 150));

// Explicación de la tabla de activos
$porcentaje_activos = $resultado_activos->num_rows > 0 ? 
    round(($resultado_activos->num_rows / $resultado->num_rows) * 100, 2) : 0;

$pdf->addExplanation('ANÁLISIS DE USUARIOS ACTIVOS', 
    "Los usuarios activos representan el $porcentaje_activos% del total de usuarios registrados. ".
    "Estos usuarios tienen acceso completo al sistema según su rol asignado. ".
    "Mantener esta lista actualizada es crucial para la seguridad informática de la empresa.");

// Consulta para usuarios inactivos (estado = 0)
$sql_inactivos = "SELECT id, nombre_usuario, nombre FROM usuarios WHERE estado = 0";
$resultado_inactivos = $conexion->query($sql_inactivos);

$data_inactivos = array();
if ($resultado_inactivos->num_rows > 0) {
    while ($fila = $resultado_inactivos->fetch_assoc()) {
        $data_inactivos[] = array($fila['id'], $fila['nombre_usuario'], $fila['nombre']);
    }
}

// Crear tabla de usuarios inactivos
$header_inactivos = array('ID', 'Usuario', 'Nombre');
$pdf->crearTablaEstado($header_inactivos, $data_inactivos, 'TABLA DE USUARIOS INACTIVOS', array(255, 200, 200));

// Explicación de la tabla de inactivos
$porcentaje_inactivos = $resultado_inactivos->num_rows > 0 ? 
    round(($resultado_inactivos->num_rows / $resultado->num_rows) * 100, 2) : 0;

$pdf->addExplanation('ANÁLISIS DE USUARIOS INACTIVOS', 
    "Los usuarios inactivos representan el $porcentaje_inactivos% del total. ".
    "Estos usuarios no tienen acceso al sistema actualmente. Es recomendable revisar ".
    "periódicamente esta lista para determinar si estos usuarios deben ser reactivados o eliminados definitivamente.");

// Conclusiones
$pdf->addExplanation('CONCLUSIONES Y RECOMENDACIONES', 
    "• Total de usuarios en el sistema: " . $resultado->num_rows . "\n" .
    "• Usuarios activos: " . $resultado_activos->num_rows . " (" . $porcentaje_activos . "%)\n" .
    "• Usuarios inactivos: " . $resultado_inactivos->num_rows . " (" . $porcentaje_inactivos . "%)\n\n" .
    "Se recomienda realizar auditorías periódicas para mantener actualizada la base de datos de usuarios, " .
    "especialmente revisando aquellos que llevan mucho tiempo inactivos. " .
    "También es importante verificar que los roles asignados correspondan a las funciones actuales de cada usuario.");

// Cerrar la conexión a la base de datos
$conexion->close();

// Limpiar cualquier salida antes de generar el PDF
ob_end_clean();

// Generar el archivo PDF
$pdf->Output('Informe_Usuarios.pdf', 'I');
?>
