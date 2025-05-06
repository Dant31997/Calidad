<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>

</body>

</html>

<?php
header('Content-Type: text/html; charset=UTF-8');

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
$id = $_POST['id'];
$nombre_trabajador = $_POST['Nombre_trabajador'];
$inventario = $_POST['inventario'];
$cantidad = $_POST['cantidad'];
$estado = "Prestado";
$Hora_entrega = $_POST['Hora_entrega'];
$Hora_regreso = $_POST['Hora_regreso'];

// Inserta en la tabla prestamos_insumos
$sql_insert = "INSERT INTO prestamos_insumos (insumo, cantidad, nombre_persona_prestamo, estado, desde, hasta) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);

if ($stmt_insert) {
    $stmt_insert->bind_param("ssssss", $inventario, $cantidad, $nombre_trabajador, $estado, $Hora_entrega, $Hora_regreso);
    if ($stmt_insert->execute()) {
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
        // Actualiza la tabla peticiones_insumos
        $sql_update = "UPDATE peticiones_insumos SET estado_peticion = 'Aprobada' WHERE id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("i", $id);
        $stmt_update->execute();
        $stmt_update->close();

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Peticion aceptada correctamente.'
            }).then(() => {
                window.location.href = 'verificarPeticionesInsumos.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo asignar el insumo. Inténtalo de nuevo.'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
    $stmt_insert->close();
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al preparar la consulta.'
        }).then(() => {
            window.history.back();
        });
    </script>";
}

// Cierra la conexión
$conexion->close();
?>
<!-- Incluye SweetAlert2 -->