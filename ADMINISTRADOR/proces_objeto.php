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

    try {
        if ($stmt->execute()) {
            echo "<script>alert('El objeto fue agregado con éxito.');</script>";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // Código de error para "Duplicate entry"
            echo "<script>alert('Error: El objeto ya existe en el inventario.');
            window.history.back()
            </script>";
        } else {
            echo "<script>alert('Error al agregar el objeto de inventario: " . $e->getMessage() . "');</script>";
        }
    }
}
?>
<meta http-equiv="Refresh" content="1; url='http://localhost/proyectofinal/ADMINISTRADOR/agregarobjeto.php'" />