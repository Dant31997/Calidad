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
// Configuración inicial
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

// Recibir los datos enviados desde el formulario
$id = $_POST['id'];
$nombre_trabajador = $_POST['Nombre_trabajador'];
$nom_espacio = $_POST['nom_espacio'];
$estado = "Reservado";
$fecha_entrega = $_POST['fecha_entrega'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

// Inserta en la tabla prestamos_espacios
$sql_insert = "INSERT INTO prestamos_espacios (espacio, nom_persona, estado, fecha_entrega, desde, hasta) 
               VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);

if ($stmt_insert) {
    $stmt_insert->bind_param("ssssss", $nom_espacio, $nombre_trabajador, $estado, $fecha_entrega, $desde, $hasta);

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
        // Actualiza la tabla peticones_espacios
        $sql_update = "UPDATE peticiones_espacios SET estado_peticion = 'Aprobada' WHERE id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("i", $id);
        $stmt_update->execute();
        $stmt_update->close();

        // Actualiza la tabla espacios
        $sql_update_espacio = "UPDATE espacios SET estado_espacio = 'Reservado' WHERE nom_espacio = ?";
        $stmt_update_espacio = $conexion->prepare($sql_update_espacio);
        $stmt_update_espacio->bind_param("s", $nom_espacio);
        $stmt_update_espacio->execute();
        $stmt_update_espacio->close();
        
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Peticion aceptada correctamente.'
            }).then(() => {
                window.location.href = 'verificarPeticionesEspacios.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo asignar el Espacio. Inténtalo de nuevo.'
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