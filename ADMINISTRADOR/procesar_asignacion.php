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

// Verificar disponibilidad de insumos
$sql_verificar = "SELECT COUNT(*) as total FROM inventario WHERE nom_inventario = ? AND estado = 'Libre'";
$stmt_verificar = $conexion->prepare($sql_verificar);

if ($stmt_verificar) {
    $stmt_verificar->bind_param("s", $inventario);
    $stmt_verificar->execute();
    $result = $stmt_verificar->get_result();
    $row = $result->fetch_assoc();
    $total_disponible = $row['total'];

    // Comparar cantidad solicitada con disponibilidad
    if ((int)$cantidad > $total_disponible) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'No hay suficientes unidades de $inventario para esta peticion'
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit;
    }

    $stmt_verificar->close();
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al verificar disponibilidad de insumos.'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit;
}

// Inserta en la tabla prestamos_insumos
$sql_insert = "INSERT INTO prestamos_insumos (insumo, cantidad, nombre_persona_prestamo, estado, desde, hasta) 
                VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);

if ($stmt_insert) {
    $stmt_insert->bind_param("ssssss", $inventario, $cantidad, $nombre_trabajador, $estado, $Hora_entrega, $Hora_regreso);

    if ($stmt_insert->execute()) {
        $ultimo_id = $conexion->insert_id;
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
        $sql_update = "UPDATE peticiones_insumos SET estado_peticion = 'Aprobada', id_prestamo = ? WHERE id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("ii", $ultimo_id, $id);
        $stmt_update->execute();
        $stmt_update->close();

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Peticion aceptada correctamente.'
            }).then(() => {
                window.location.href = 'lista_inventario.php?id=" . urlencode($id) . "&inventario=" . urlencode($inventario) . "&cantidad=" . urlencode($cantidad) . "&nombre_trabajador=" . urlencode($nombre_trabajador) . "&prestamo_id=" . urlencode($ultimo_id) .  "';
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


$conexion->close();
?>