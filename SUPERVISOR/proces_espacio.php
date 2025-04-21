<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Procesar el formulario para agregar un nuevo objeto de inventario
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $persona_encargada = "-";
    $fecha_prestamo = "-";
    $regreso = "-";

    $sql = "INSERT INTO espacios (nom_espacio, estado_espacio, persona_encargada, dh_espacio, dh_regreso) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sssss', $nombre, $estado, $persona_encargada, $fecha_prestamo, $regreso);

    if ($stmt->execute()) {
        echo"<script>alert('El espacio fue agregado con éxito.');</script>";
    } else {
        echo "Error al agregar el espacio. " . $stmt->error;
    }
}
?>
<meta http-equiv="Refresh" content="1; url='http://localhost/proyecto/espacios.php'" />