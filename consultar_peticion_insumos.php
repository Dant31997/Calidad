<?php
header('Content-Type: application/json');

$conexion = new mysqli("localhost", "root", "", "basededatos");

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

$idPeticion = isset($_POST['idPeticion']) ? intval($_POST['idPeticion']) : 0;

$sql = "SELECT id, estado_peticion FROM peticiones_insumos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idPeticion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'id' => $row['id'], 'estado_peticion' => $row['estado_peticion']]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontró la petición con el ID proporcionado.']);
}

$stmt->close();
$conexion->close();
?>