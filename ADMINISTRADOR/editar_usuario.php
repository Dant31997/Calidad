<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del formulario
$usuario_id = $_POST['usuario_id'];
$nuevo_usuario = $_POST['nuevo_usuario'];
$nuevo_nombre = $_POST['nuevo_nombre'];
$nuevo_rol = $_POST['nuevo_rol'];

// Inicializa la parte SET de la consulta SQL
$set = array();
$tipos = "";
$valores = array();

if (!empty($nuevo_usuario)) {
    $set[] = "nombre_usuario = ?";
    $tipos .= 's';
    $valores[] = $nuevo_usuario;
}
if (!empty($nuevo_nombre)) {
    $set[] = "nombre = ?";
    $tipos .= 's';
    $valores[] = $nuevo_nombre;
}
if (!empty($nuevo_rol)) {
    $set[] = "rol = ?";
    $tipos .= 's';
    $valores[] = $nuevo_rol;
}


// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE usuarios SET " . implode(", ", $set) . " WHERE id = ?";
$tipos .= 'i'; // Agrega el tipo de dato para el ID
$valores[] = $usuario_id;

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

<meta http-equiv="Refresh" content="1; url='listar_usuarios.php'" />