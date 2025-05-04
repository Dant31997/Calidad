<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

try {
    // Verifica la conexión
    if ($conexion->connect_error) {
        throw new Exception("Error en la conexión: " . $conexion->connect_error);
    }

    // Procesar el formulario para agregar un nuevo objeto de inventario
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $Descripcion = $_POST['Descripcion'];
        $capacidad = $_POST['capacidad'];
        $estado = $_POST['estado'];

        $sql = "INSERT INTO espacios (nom_espacio, Descripcion, capacidad, estado_espacio) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param('ssss', $nombre, $Descripcion, $capacidad, $estado);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El espacio fue agregado con éxito.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'espacios.php';
                });
            </script>";
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }
    }
} catch (Exception $e) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '" . $e->getMessage() . "',
            confirmButtonText: 'Aceptar'
        });
    </script>";
} finally {
    $conexion->close();
}
?>