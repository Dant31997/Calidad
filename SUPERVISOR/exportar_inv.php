<?php
// Turn off warnings and notices to prevent output before PDF generation
error_reporting(E_ERROR);
ini_set('display_errors', 0);

require('fpdf.php');

class PDF extends FPDF {
    // Variables para estadísticas
    private $totalInventario = 0;
    private $estadisticasPorEstado = [];
    
    function Header() {
        // Logo (reemplazar con ruta a tu logo)
        // $this->Image('logo.png', 10, 6, 30);
        
        // Encabezado con fecha
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode('INFORME DE INVENTARIO'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 6, 'Empresa XYZ', 0, 1, 'C');
        $this->Cell(0, 6, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
        $this->Line(10, $this->GetY() + 3, 280, $this->GetY() + 3); // Ajustado para formato horizontal
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-20);
        $this->Line(10, $this->GetY(), 280, $this->GetY()); // Ajustado para formato horizontal
        $this->Ln(5);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 6, 'Informe generado el ' . date('d/m/Y H:i:s'), 0, 1, 'L');
        $this->Cell(135, 6, 'Contacto: inventario@empresaxyz.com', 0, 0, 'L'); // Ajustado
        $this->Cell(135, 6, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R'); // Ajustado
    }

    function TableHeader($headers) {
        $this->SetFillColor(220, 220, 220);
        $this->SetFont('Arial', 'B', 11);
        foreach ($headers as $header) {
            $this->Cell($header['width'], 8, utf8_decode($header['title']), 1, 0, 'C', true);
        }
        $this->Ln();
    }

    function TableRow($data, $widths, $fill = false) {
        $this->SetFont('Arial', '', 10);
        
        // Guardar la posición X inicial
        $x = $this->GetX();
        $y = $this->GetY();
        $maxHeight = 7; // Altura mínima de fila
        
        // Calcular la altura necesaria para la celda de descripción (índice 2)
        $this->SetXY($x + $widths[0] + $widths[1], $y);
        $descripHeight = $this->GetMultiCellHeight($widths[2], 7, utf8_decode($data[2]));
        $maxHeight = max($maxHeight, $descripHeight);
        
        // Restablecer la posición
        $this->SetXY($x, $y);
        
        // Primero dibujamos todas las celdas de fondo y bordes
        $currentX = $x;
        for ($i = 0; $i < count($data); $i++) {
            if ($fill) {
                $this->SetFillColor(240, 240, 240);
                $this->Rect($currentX, $y, $widths[$i], $maxHeight, 'F');
            }
            $this->Rect($currentX, $y, $widths[$i], $maxHeight, 'D');
            $currentX += $widths[$i];
        }
        
        // Luego dibujamos el contenido
        $currentX = $x;
        foreach ($data as $key => $value) {
            if ($key === 2) { // Columna de Descripción
                // Dibujar el texto con multicell
                $this->SetXY($currentX, $y);
                $this->MultiCell($widths[$key], 7, utf8_decode($value), 0, 'L');
            } else {
                // Para otras columnas, dibujar el texto con Cell pero sin bordes
                $align = is_numeric($value) ? 'R' : 'L';
                $this->SetXY($currentX, $y);
                $this->Cell($widths[$key], $maxHeight, utf8_decode($value), 0, 0, $align);
            }
            $currentX += $widths[$key];
        }
        
        // Avanzar a la siguiente línea
        $this->SetY($y + $maxHeight);
    }
    
    // Función auxiliar para calcular la altura de una MultiCell
    function GetMultiCellHeight($w, $h, $txt) {
        $text = $txt;
        // Obtener el número de líneas que ocuparía el texto
        $cw = &$this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',$text);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb) {
            $c = $s[$i];
            if($c=="\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $this->GetStringWidth($c) * 1000 / $this->FontSize;
            if($l>$wmax) {
                if($sep==-1) {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $h*$nl;
    }

    function SectionTitle($title) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(0, 8, utf8_decode($title), 0, 1, 'L');
        $this->Line(10, $this->GetY(), 80, $this->GetY()); // Ajustado para formato horizontal
        $this->Ln(2);
    }
    
    function PieChart($data, $x, $y, $radius) {
        // Resto del código de PieChart igual...
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.2);
        
        $total = array_sum(array_column($data, 'value'));
        $startAngle = 0;
        
        // Definir colores para el gráfico
        $colors = [
            [41, 128, 185], // Azul - Libre
            [39, 174, 96], // Verde - Prestado
            [231, 76, 60], // Rojo - Averiado
            [243, 156, 18] // Naranja - Bodega
        ];
        
        // Dibujar leyenda
        $legendX = $x + $radius + 10;
        $legendY = $y - $radius + 5;
        
        $this->SetFont('Arial', '', 8);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['value'] > 0) {
                // Calcular el porcentaje
                $percentage = round(($data[$i]['value'] / $total) * 100, 1);
                
                // Calcular ángulos
                $endAngle = $startAngle + ($percentage * 3.6); // 3.6 grados por porcentaje
                
                // Dibujar sector
                $this->SetFillColor($colors[$i][0], $colors[$i][1], $colors[$i][2]);
                
                // Sector
                $this->Sector($x, $y, $radius, $startAngle, $endAngle);
                
                // Leyenda
                $this->Rect($legendX, $legendY, 5, 5, 'F');
                $this->SetXY($legendX + 7, $legendY);
                $this->Cell(
                    60, 
                    5, 
                    utf8_decode($data[$i]['label']) . ': ' . $data[$i]['value'] . ' (' . $percentage . '%)', 
                    0, 
                    0, 
                    'L'
                );
                
                $startAngle = $endAngle;
                $legendY += 8;
            }
        }
    }
    
    // Las funciones auxiliares como Sector, Ellipse, Pieslice, _Arc se mantienen iguales
    function Sector($xc, $yc, $r, $a, $b) {
        $this->Ellipse($xc, $yc, $r, $r, 0);
        $this->Pieslice($xc, $yc, $r, $r, 0, $a, $b);
    }
    
    function Ellipse($x, $y, $rx, $ry, $style='D') {
        if($style=='F') $op='f';
        elseif($style=='FD' || $style=='DF') $op='B';
        else $op='S';
        
        $lx=4/3*(M_SQRT2-1)*$rx;
        $ly=4/3*(M_SQRT2-1)*$ry;
        
        $k=$this->k;
        $h=$this->h;
        
        $this->_out(sprintf('%.2F %.2F m %.2F %.2F %.2F %.2F %.2F %.2F c',
            ($x)*$k, ($h-$y)*$k,
            ($x+$lx)*$k, ($h-$y)*$k,
            ($x+$rx)*$k, ($h-$y+$ly)*$k,
            ($x+$rx)*$k, ($h-$y+$ry)*$k));
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
            ($x+$rx)*$k, ($h-$y+$ry+$ly)*$k,
            ($x+$lx)*$k, ($h-$y+$ry*2)*$k,
            ($x)*$k, ($h-$y+$ry*2)*$k));
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
            ($x-$lx)*$k, ($h-$y+$ry*2)*$k,
            ($x-$rx)*$k, ($h-$y+$ry+$ly)*$k,
            ($x-$rx)*$k, ($h-$y+$ry)*$k));
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c %s',
            ($x-$rx)*$k, ($h-$y+$ly)*$k,
            ($x-$lx)*$k, ($h-$y)*$k,
            ($x)*$k, ($h-$y)*$k,
            $op));
    }
    
    function Pieslice($xc, $yc, $rx, $ry, $a, $b, $c=0, $style='FD') {
        if($style=='F') $op='f';
        elseif($style=='FD' || $style=='DF') $op='B';
        else $op='S';
        
        // Fix for deprecated float to int conversion
        if($c==0) $d=(float)(M_PI/2);
        else $d=(float)(M_PI*2-$c); // Explicitly keep as float
        
        $a = (float)(-$a * M_PI/180); // Convertir a radianes
        $b = (float)(-$b * M_PI/180);
        
        $x0 = $xc + $rx*cos($a);
        $y0 = $yc - $ry*sin($a);
        $x1 = $xc + $rx*cos($b);
        $y1 = $yc - $ry*sin($b);
        
        $this->_Arc($xc, $yc, $rx, $ry, $a, $b);
        $this->_out(sprintf('%.2F %.2F l', $xc*$this->k, ($this->h-$yc)*$this->k));
        $this->_out(sprintf('%.2F %.2F l', $x0*$this->k, ($this->h-$y0)*$this->k));
        $this->_out($op);
    }
    
    function _Arc($x1, $y1, $rx, $ry, $a1, $a2) {
        $k = $this->k;
        $h = $this->h;
        $a1 = $a1 % (2*M_PI);
        $a2 = $a2 % (2*M_PI);
        if($a1 > $a2) $a2 += 2*M_PI;
        $da = $a2 - $a1;
        
        if($rx == 0 || $ry == 0 || $da == 0) return;
        
        if($da > (M_PI/2)) {
            $this->_Arc($x1, $y1, $rx, $ry, $a1, $a1 + ($da/2));
            $this->_Arc($x1, $y1, $rx, $ry, $a1 + ($da/2), $a2);
            return;
        }
        
        $cos_a1 = cos($a1);
        $sin_a1 = sin($a1);
        $cos_a2 = cos($a2);
        $sin_a2 = sin($a2);
        
        $t = tan($da/4);
        
        $h = (4/3) * $rx * $t;
        $k = (4/3) * $ry * $t;
        
        $m1 = array($x1 + $rx * $cos_a1, $y1 - $ry * $sin_a1);
        $m2 = array($m1[0] - $h * $sin_a1, $m1[1] - $k * $cos_a1);
        
        $m4 = array($x1 + $rx * $cos_a2, $y1 - $ry * $sin_a2);
        $m3 = array($m4[0] + $h * $sin_a2, $m4[1] + $k * $cos_a2);
        
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
            $m2[0]*$this->k, ($this->h-$m2[1])*$this->k,
            $m3[0]*$this->k, ($this->h-$m3[1])*$this->k,
            $m4[0]*$this->k, ($this->h-$m4[1])*$this->k
        ));
    }

    // Agregar estadísticas al objeto
    function setEstadisticas($estado, $total) {
        $this->estadisticasPorEstado[$estado] = $total;
        $this->totalInventario += $total;
    }
    
    // Obtener el porcentaje de un estado
    function getPorcentaje($estado) {
        if ($this->totalInventario == 0) return 0;
        return isset($this->estadisticasPorEstado[$estado]) ? 
               ($this->estadisticasPorEstado[$estado] / $this->totalInventario) * 100 : 0;
    }
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");
$conexion->set_charset("utf8"); // Establecer conexión con soporte UTF-8

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Crear un nuevo objeto PDF especificando orientación horizontal
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages(); // Para mostrar el total de páginas
$pdf->AddPage();

// INICIO DEL NUEVO CÓDIGO - Listado completo de inventario
// Función para obtener todos los registros de inventario
function obtenerTodosRegistros($conexion) {
    $sql = "SELECT cod_inventario, nom_inventario, Descripcion, estado FROM inventario ORDER BY cod_inventario";
    return $conexion->query($sql);
}

// Obtener todos los registros para la tabla completa
$todosRegistros = obtenerTodosRegistros($conexion);

// Mostrar tabla completa de inventario al inicio
$pdf->SectionTitle("Listado Completo de Inventario");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode('A continuación se presenta el listado completo de todos los elementos registrados en el inventario:'), 0, 'J');
$pdf->Ln(3);

// Definir anchos de columnas para la tabla completa
$anchosCompleto = [20, 40, 110, 25]; // Código, Tipo, Descripción, Estado

// Encabezado de la tabla completa
$pdf->TableHeader([
    ['title' => 'Código', 'width' => $anchosCompleto[0]],
    ['title' => 'Tipo de Insumo', 'width' => $anchosCompleto[1]],
    ['title' => 'Descripción', 'width' => $anchosCompleto[2]],
    ['title' => 'Estado', 'width' => $anchosCompleto[3]]
]);

// Poblar la tabla
$fill = false;
$contador = 0;
$maxItems = 25; // Número máximo de elementos por página
$totalRegistros = $todosRegistros->num_rows;

while ($registro = $todosRegistros->fetch_assoc()) {
    // Si necesitamos una nueva página después de cierto número de filas
    if ($contador > 0 && $contador % $maxItems == 0) {
        $pdf->AddPage();
        $pdf->SectionTitle("Listado Completo de Inventario (continuación)");
        $pdf->TableHeader([
            ['title' => 'Código', 'width' => $anchosCompleto[0]],
            ['title' => 'Tipo de Insumo', 'width' => $anchosCompleto[1]],
            ['title' => 'Descripción', 'width' => $anchosCompleto[2]],
            ['title' => 'Estado', 'width' => $anchosCompleto[3]]
        ]);
    }
    
    $pdf->TableRow([
        $registro['cod_inventario'],
        $registro['nom_inventario'],
        $registro['Descripcion'],
        $registro['estado']
    ], $anchosCompleto, $fill);
    
    $fill = !$fill;
    $contador++;
}

// Mostrar conteo total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, utf8_decode("Total de registros: $totalRegistros"), 0, 1, 'R');
$pdf->Ln(10);

// Agregar página para continuar con el resto del informe
$pdf->AddPage();
// FIN DEL NUEVO CÓDIGO - Listado completo de inventario

// Agregar resumen ejecutivo
$pdf->SectionTitle("Resumen Ejecutivo");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode('Este informe presenta un análisis detallado del inventario actual de la empresa XYZ, clasificando los insumos por su estado (Libre, Prestado, Averiado, Bodega) y proporcionando datos estadísticos relevantes para la toma de decisiones de gestión de inventario.'), 0, 'J');
$pdf->Ln(5);


// Función para obtener y contar registros por estado
function obtenerDatosPorEstado($conexion, $estado) {
    $sql = "SELECT nom_inventario, COUNT(*) as total FROM inventario WHERE estado = ? GROUP BY nom_inventario ORDER BY total DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $estado);
    $stmt->execute();
    return $stmt->get_result();
}

// Función para calcular totales
function calcularTotales($conexion) {
    $sql = "SELECT estado, COUNT(*) as total FROM inventario GROUP BY estado ORDER BY total DESC";
    return $conexion->query($sql);
}

// Estados a procesar
$estados = ['Libre', 'Prestado', 'Averiado', 'Bodega'];
$widths = [110, 80]; // Ancho de las columnas ajustado para formato horizontal

// Acumular datos para gráfico
$datosGrafico = [];
$resultadosTotales = calcularTotales($conexion);
while ($fila = $resultadosTotales->fetch_assoc()) {
    $pdf->setEstadisticas($fila['estado'], $fila['total']);
    $datosGrafico[] = [
        'label' => $fila['estado'],
        'value' => $fila['total']
    ];
}
$resultadosTotales->data_seek(0); // Reiniciar cursor


// Para cada estado, crear una tabla con los insumos
foreach ($estados as $estado) {
    $resultado = obtenerDatosPorEstado($conexion, $estado);
    $totalInsumos = 0;
    $datos = [];
    
    // Almacenar resultados en un array para obtener estadísticas
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
        $totalInsumos += $fila['total'];
    }
    
    // Si hay datos, mostrarlos
    if (count($datos) > 0) {
        $porcentaje = $pdf->getPorcentaje($estado);
        
        $pdf->SectionTitle("Insumos con estado: $estado");
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 6, utf8_decode("Total de insumos en estado '$estado': $totalInsumos (" . 
                         number_format($porcentaje, 1) . "% del inventario total)"), 0, 'L');
        $pdf->Ln(2);
        
        $pdf->TableHeader([
            ['title' => 'Nombre de Inventario', 'width' => $widths[0]],
            ['title' => 'Cantidad', 'width' => $widths[1]]
        ]);
        
        $fill = false;
        foreach ($datos as $i => $fila) {
            // Limitar a 15 filas por estado, si hay más, mostrar mensaje
            if ($i < 15) {
                $pdf->TableRow([$fila['nom_inventario'], $fila['total']], $widths, $fill);
                $fill = !$fill; // Alternar colores
            } else {
                $pdf->SetFont('Arial', 'I', 10);
                $pdf->Cell(0, 7, utf8_decode('... y ' . (count($datos) - 15) . ' insumos más'), 0, 1, 'C');
                break;
            }
        }
    } else {
        $pdf->SectionTitle("Insumos con estado: $estado");
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'No hay registros para este estado.', 0, 1);
    }
    $pdf->Ln(5);
}

// Agregar página para resumen 
$pdf->AddPage();

// Función para obtener resumen detallado
function obtenerResumenDetallado($conexion) {
    $sql = "SELECT estado, nom_inventario, COUNT(*) as total 
            FROM inventario 
            GROUP BY estado, nom_inventario 
            ORDER BY estado, total DESC";
    return $conexion->query($sql);
}

// Obtener datos detallados para el resumen
$resultadosDetallados = obtenerResumenDetallado($conexion);

// Ajustar anchos de columnas para incluir nombre de inventario
$widthsDetallados = [50, 90, 50]; // Estado, Nombre, Total

// Primera columna: Tabla de resumen
$pdf->SetLeftMargin(10);
$pdf->SectionTitle("Resumen General de Inventario");
$pdf->TableHeader([
    ['title' => 'Estado', 'width' => $widthsDetallados[0]],
    ['title' => 'Nombre Inventario', 'width' => $widthsDetallados[1]],
    ['title' => 'Total de Unidades', 'width' => $widthsDetallados[2]]
]);

$fill = false;
$totalGeneral = 0;
$estadoActual = "";

while ($fila = $resultadosDetallados->fetch_assoc()) {
    // Si cambiamos de estado, añadir un pequeño espacio visual
    if ($estadoActual != "" && $estadoActual != $fila['estado']) {
        $pdf->Ln(1);
    }
    $estadoActual = $fila['estado'];
    
    $pdf->TableRow([
        $fila['estado'], 
        $fila['nom_inventario'],
        $fila['total']
    ], $widthsDetallados, $fill);
    
    $totalGeneral += $fila['total'];
    $fill = !$fill;
}

// Añadir fila de totales
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($widthsDetallados[0] + $widthsDetallados[1], 7, 'TOTAL INVENTARIO:', 1, 0, 'R', true);
$pdf->Cell($widthsDetallados[2], 7, $totalGeneral, 1, 1, 'R', true);
$pdf->Ln(5);


//------------------------------------------//

// Análisis y recomendaciones
$pdf->SectionTitle("Análisis y Recomendaciones");
$pdf->SetFont('Arial', '', 10);

// Análisis basados en los datos
$analisis = [];

// Analizar porcentaje de insumos libres
$porcentajeLibre = $pdf->getPorcentaje('Libre');
if ($porcentajeLibre < 30) {
    $analisis[] = "- Baja disponibilidad de insumos: Solo el " . number_format($porcentajeLibre, 1) . 
                "% del inventario está disponible. Se recomienda evaluar la adquisición de más unidades.";
} else if ($porcentajeLibre > 70) {
    $analisis[] = "- Alta disponibilidad de insumos: El " . number_format($porcentajeLibre, 1) . 
                "% del inventario está disponible. Podría indicar una subutilización de recursos.";
}

// Analizar porcentaje de insumos averiados
$porcentajeAveriado = $pdf->getPorcentaje('Averiado');
if ($porcentajeAveriado > 10) {
    $analisis[] = "- Tasa de averías elevada: El " . number_format($porcentajeAveriado, 1) . 
                "% del inventario está averiado. Se recomienda revisar los procesos de mantenimiento.";
}

// Analizar porcentaje de insumos prestados
$porcentajePrestado = $pdf->getPorcentaje('Prestado');
if ($porcentajePrestado > 50) {
    $analisis[] = "- Alta demanda: El " . number_format($porcentajePrestado, 1) . 
                "% del inventario está prestado. Considerar ampliar el inventario de estos insumos.";
}

// Analizar porcentaje de insumos en bodega
$porcentajeBodega = $pdf->getPorcentaje('Bodega');
if ($porcentajeBodega > 40) {
    $analisis[] = "- Exceso de almacenamiento: El " . number_format($porcentajeBodega, 1) . 
                "% del inventario está en bodega. Evaluar si estos insumos son necesarios o pueden redistribuirse.";
}

// Si no hay análisis específicos, mostrar mensaje general
if (empty($analisis)) {
    $analisis[] = "- El inventario muestra una distribución equilibrada entre sus diferentes estados.";
}

// Mostrar cada punto de análisis
foreach ($analisis as $punto) {
    $pdf->MultiCell(0, 6, utf8_decode($punto), 0, 'J');
    $pdf->Ln(2);
}

// Conclusión general
$pdf->Ln(5);
$pdf->SectionTitle("Conclusión");
$pdf->MultiCell(0, 6, 
    utf8_decode("Este informe proporciona una visión general del estado actual del inventario de la empresa XYZ. " .
    "Los datos presentados facilitan la identificación de patrones en la utilización y disponibilidad de insumos, " .
    "lo que resulta esencial para optimizar la gestión del inventario y mejorar la eficiencia operativa. " .
    "Se recomienda actualizar este informe regularmente para mantener un seguimiento adecuado del estado del inventario."), 
    0, 'J');

// Fecha de generación
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 6, utf8_decode('Informe generado el ' . date('d/m/Y') . ' a las ' . date('H:i:s')), 0, 1, 'R');

// Cerrar la conexión a la base de datos
$conexion->close();

// Generar el archivo PDF
$pdf->Output('Informe_Inventario_' . date('Y-m-d') . '.pdf', 'I');
?>