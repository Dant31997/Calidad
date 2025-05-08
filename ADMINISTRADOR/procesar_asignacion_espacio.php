<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos.']);
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
$stmt_insert->bind_param("ssssss", $nom_espacio, $nombre_trabajador, $estado, $fecha_entrega, $desde, $hasta);

if ($stmt_insert->execute()) {
    // Actualiza la tabla espacios
    $sql_update = "UPDATE espacios SET estado_espacio = 'Reservado' WHERE nom_espacio = ?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("s", $nom_espacio);

    if ($stmt_update->execute()) {
        echo json_encode(['success' => true, 'reload' => true]); // Agrega 'reload' en la respuesta
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el inventario de espacios.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error al insertar en prestamos_espacios.']);
}

// Cierra las conexiones
$stmt_insert->close();
$stmt_update->close();
$conexion->close();
?>