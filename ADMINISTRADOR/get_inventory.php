<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtener el ID del préstamo
$id_prestamo = isset($_GET['id_prestamo']) ? intval($_GET['id_prestamo']) : 0;

// Sanitizar el parámetro
$id_prestamo = $conexion->real_escape_string($id_prestamo);

// Consulta para obtener items del inventario relacionados con el préstamo
$sql = "SELECT * FROM inventario WHERE id_prestamo = '$id_prestamo'";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    // Mostrar registros
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['cod_inventario']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['nom_inventario']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['Descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['prestado_a']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['estado']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron items de inventario para este préstamo</td></tr>";
}

$conexion->close();
?>