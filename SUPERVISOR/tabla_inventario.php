<?php
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Verifica si es una solicitud AJAX
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    $registrosPorPagina2 = 6;
    $paginaActual2 = isset($_GET['pagina2']) ? $_GET['pagina2'] : 1;

    $offset2 = ($paginaActual2 - 1) * $registrosPorPagina2;
    $sql2 = "SELECT 
    ti.nombre_insumo, 
    COALESCE(COUNT(i.nom_inventario), 0) as cantidad,
    COALESCE(SUM(CASE WHEN i.estado = 'Libre' THEN 1 ELSE 0 END), 0) as libres
FROM tipo_insumo ti 
LEFT JOIN inventario i ON ti.nombre_insumo = i.nom_inventario 
GROUP BY ti.nombre_insumo 
ORDER BY ti.nombre_insumo ASC 
LIMIT $offset2, $registrosPorPagina2";
    $resultado2 = $conexion->query($sql2);

    // Consulta SQL para obtener el número total de registros
    $totalRegistros2 = $conexion->query("SELECT COUNT(*) as total FROM (
    SELECT ti.nombre_insumo 
    FROM tipo_insumo ti 
    GROUP BY ti.nombre_insumo
) as subquery")->fetch_assoc()['total'];


    // Calcular el número total de páginas
    $numTotalPaginas2 = ceil($totalRegistros2 / $registrosPorPagina2);
}
?>
<table class="tabla-resumen">
    <thead>
        <tr>
            <th>Nombre del Insumo</th>
            <th>Cantidad</th>
            <th>Libres</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultado2->num_rows > 0) {
            while ($row = $resultado2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nombre_insumo'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>" . $row['libres'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No hay datos disponibles</td></tr>";
        }
        ?>
    </tbody>
</table>
<div class="pagination2">
    <?php
    for ($i2 = 1; $i2 <= $numTotalPaginas2; $i2++) {
        $claseActiva2 = ($i2 == $paginaActual2) ? "active2" : "";
        echo "<a class='$claseActiva2' href='#' data-pagina2='$i2'>$i2</a>";
    }
    ?>
</div>