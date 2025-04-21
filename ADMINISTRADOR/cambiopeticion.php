<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del formulario
$cod_inventario = $_POST['cod_inventario'];
$nombre_persona = $_POST['nombre_persona'];
$equipo = $_POST['equipo'];
$estado = $_POST['estado'];

// Inicializa la parte SET de la consulta SQL
$set = array();
$tipos = "";
$valores = array();

if (!empty($estado)) {
    $set[] = "estado_peticion = ?";
    $tipos .= 's';
    $valores[] = $estado;
}

if (!empty($nombre_persona)) {
    $set[] = "pide = ?";
    $tipos .= 's';
    $valores[] = $nombre_persona;
}

if (!empty($equipo)) {
    $set[] = "equipo = ?";
    $tipos .= 's';
    $valores[] = $equipo;
}

// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE peticiones_insumos SET " . implode(", ", $set) . " WHERE id = ?";
$tipos .= 'i'; // Agrega el tipo de dato para el ID
$valores[] = $cod_inventario;

$stmt = $conexion->prepare($sql);
$stmt->bind_param($tipos, ...$valores);

if ($stmt->execute()) {
    echo "Campos actualizados correctamente.";
} else {
    echo "Error al actualizar los campos: " . $stmt->error;
}

// Cierra la conexión
$conexion->close();
?>

<meta http-equiv="Refresh" content="1; url='verificarPeticionesInsumos.php'" />
