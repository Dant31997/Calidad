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

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cod_espacio'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar a la base de datos.'
            });
        </script>";
        exit();
    }

    $cod_espacio = $_GET['cod_espacio'];

    try {
        // Consulta SQL para eliminar el espacio por ID
        $sql = "DELETE FROM espacios WHERE cod_espacio = $cod_espacio";

        if ($conexion->query($sql) === TRUE) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Espacio eliminado!',
                    text: 'El espacio se eliminó correctamente.'
                }).then(() => {
                    window.location.href = 'espacios.php';
                });
            </script>";
        } else {
            throw new Exception("Error al eliminar el espacio: " . $conexion->error);
        }
    } catch (Exception $e) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '" . $e->getMessage() . "'
            });
        </script>";
    } finally {
        $conexion->close();
    }
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'ID no especificado',
            text: 'No se proporcionó un ID de espacio válido.'
        });
    </script>";
}
?>