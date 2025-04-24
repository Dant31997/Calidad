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
$nombre_trabajador = $_POST['Nombre_trabajador'];
$cod_espacio = $_POST['inventario'];
$nom_espacio = $_POST['nom_espacio'];
$fecha_entrega = $_POST['fecha_entrega'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$estado = $_POST['estado'];

// Inserta en la tabla prestamos_espacios
$sql_insert = "INSERT INTO prestamos_espacios (espacio, nom_persona, estado, fecha_entrega, desde, hasta)
               VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);
$stmt_insert->bind_param("sssddd", $nom_espacio, $nombre_trabajador, $estado, $fecha_entrega, $desde, $hasta);

if ($stmt_insert->execute()) {
    // Actualiza la tabla espacios
    $sql_update = "UPDATE espacios SET estado_espacios = 'Prestado' WHERE cod_espacio = ?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("i", $cod_espacio);

    if ($stmt_update->execute()) {
        echo json_encode(['success' => true, 'reload' => true]); // Agrega 'reload' en la respuesta
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el inventario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error al insertar en prestamos_insumos.']);
}
// Cierra las conexiones
$stmt_insert->close();
$stmt_update->close();
$conexion->close();
?>