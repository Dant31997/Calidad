<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>
<?php
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$id = $_GET['id'];

if ($id) {
    $sql = "UPDATE peticiones_espacios SET estado_peticion = 'Rechazada' WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Petición Rechazada',
                text: 'La petición ha sido rechazada.'
            }).then(() => {
                window.location.href = 'verificarPeticionesInsumos.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo rechazar la petición.'
            }).then(() => {
                window.location.href = 'verificarPeticionesInsumos.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo encontrar la petición.'
        }).then(() => {
            window.location.href = 'verificarPeticionesInsumos.php';
        });
    </script>";
}

// Cierra la conexión
$conexion->close();
?>