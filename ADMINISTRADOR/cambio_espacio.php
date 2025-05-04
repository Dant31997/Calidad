<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo conectar a la base de datos: " . $conexion->connect_error . "'
        });
    </script>";
    exit();
}

try {
    // Obtiene los datos del formulario
    $cod_espacio = $_POST['cod_espacio'];
    $nom_espacio = $_POST['nom_espacio'];
    $estado_espacio = $_POST['estado_espacio'];
    $Descripcion = $_POST['Descripcion'];
    $capacidad = $_POST['capacidad'];

    // Inicializa la parte SET de la consulta SQL
    $set = array();
    $tipos = "";
    $valores = array();

    if (!empty($nom_espacio)) {
        $set[] = "nom_espacio = ?";
        $tipos .= 's';
        $valores[] = $nom_espacio;
    }

    if (!empty($estado_espacio)) {
        $set[] = "estado_espacio = ?";
        $tipos .= 's';
        $valores[] = $estado_espacio;
    }

    if (!empty($Descripcion)) {
        $set[] = "Descripcion = ?";
        $tipos .= 's';
        $valores[] = $Descripcion;
    }

    if (!empty($capacidad)) {
        $set[] = "capacidad = ?";
        $tipos .= 's';
        $valores[] = $capacidad;
    }

    // Consulta SQL para actualizar los campos especificados
    $sql = "UPDATE espacios SET " . implode(", ", $set) . " WHERE cod_espacio = ?";
    $tipos .= 'i'; // Agrega el tipo de dato para el ID
    $valores[] = $cod_espacio;

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param($tipos, ...$valores);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Campos actualizados correctamente.'
            }).then(() => {
                window.location.href = 'espacios.php';
            });
        </script>";
    } else {
        throw new Exception("Error al actualizar los campos: " . $stmt->error);
    }
} catch (Exception $e) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '" . $e->getMessage() . "'
        });
    </script>";
} finally {
    // Cierra la conexión
    $conexion->close();
}
?>