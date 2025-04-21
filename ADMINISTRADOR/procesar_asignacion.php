<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos.']);
    exit;
}

// Obtén los datos enviados desde el formulario
$nombre_trabajador = $_POST['Nombre_trabajador'];
$cod_inventario = $_POST['inventario'];
$nom_inventario = $_POST['nom_inventario'];
$estado = $_POST['estado'];

// Inserta en la tabla prestamos_insumos
$sql_insert = "INSERT INTO prestamos_insumos (insumo, nombre_persona_prestamo, estado) VALUES (?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);
$stmt_insert->bind_param("sss", $nom_inventario, $nombre_trabajador, $estado);

if ($stmt_insert->execute()) {
    // Actualiza la tabla inventario
    $sql_update = "UPDATE inventario SET estado = 'Prestado' WHERE cod_inventario = ?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("i", $cod_inventario);

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