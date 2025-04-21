<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Procesar el formulario para agregar un nuevo objeto de inventario
if (isset($_POST['agregar'])) {
    $nombre_objeto = $_POST['nombre'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];
    

    $sql = "INSERT INTO inventario (nom_inventario, estado, descripcion) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sss', $nombre_objeto, $estado, $descripcion);

    if ($stmt->execute()) {
        echo "Objeto de inventario agregado con éxito.";
        echo"<script>alert('El objeto fue agregado con éxito.');</script>";
    } else {
        echo "Error al agregar el objeto de inventario: " . $stmt->error;
    }
}
?>
<meta http-equiv="Refresh" content="1; url='http://localhost/proyecto/inventario.php'" />