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
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error en la conexión a la base de datos.'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit;
}

// Obtén los datos enviados desde el formulario
$id_prestamo_espacio = $_POST['id_prestamo_espacio'];
$espacio = $_POST['espacio'];
$estado = "Terminado";

// Actualiza el registro en la tabla prestamos_espacios
$sql = "UPDATE prestamos_espacios 
        SET estado = '$estado', fecha_devolucion = NOW() 
        WHERE id_prestamo_espacio = $id_prestamo_espacio";

if ($conexion->query($sql) === TRUE) {
    // Si el estado del préstamo es "Cancelado" o "Terminado", actualiza el estado del espacio
    if ($estado === "Cancelado" || $estado === "Terminado") {
        $sql_espacios = "UPDATE espacios 
                         SET estado_espacio = 'Libre' 
                         WHERE nom_espacio = '$espacio'";
        $conexion->query($sql_espacios);
    }

    // Mostrar mensaje de éxito con SweetAlert2
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'El préstamo se actualizó correctamente.'
        }).then(() => {
            window.location.href = 'prestamos_insumos.php?mensaje=actualizado';
        });
    </script>";
} else {
    // Mostrar mensaje de error con SweetAlert2
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al actualizar el registro: " . $conexion->error . "'
        }).then(() => {
            window.history.back();
        });
    </script>";
}

// Cierra la conexión
$conexion->close();
