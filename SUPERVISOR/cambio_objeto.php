<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del formulario
$cod_inventario = $_POST['cod_inventario'];
$nom_inventario = $_POST['nom_inventario'];
$estado = $_POST['estado'];
$nombre_persona = $_POST['nombre_persona'];
$fecha_prestamo = ($_POST['estado'] == 'prestado') ? date('Y-m-d', time()) : 0;
$devolucion = $_POST['devolucion'];

// Inicializa la parte SET de la consulta SQL
$set = array();
$tipos = "";
$valores = array();

if (!empty($nom_inventario)) {
    $set[] = "nom_inventario = ?";
    $tipos .= 's';
    $valores[] = $nom_inventario;
}

if (!empty($estado)) {
    $set[] = "estado = ?";
    $tipos .= 's';
    $valores[] = $estado;
}

if (!empty($nombre_persona)) {
    $set[] = "nombre_persona = ?";
    $tipos .= 's';
    $valores[] = $nombre_persona;
}

if (!empty($fecha_prestamo)) {
    $set[] = "diahora_p = ?";
    $tipos .= 's';
    $valores[] = $fecha_prestamo;
} else {
    $set[] = "diahora_p = ?";
    $tipos .= 's';
    $valores[] = "0000-00-00";
}

if (!empty($devolucion)) {
    $set[] = "devolucion = ?";
    $tipos .= 's';
    $valores[] = $devolucion;
} else {
    $set[] = "devolucion = ?";
    $tipos .= 's';
    $valores[] = "0000-00-00";
}

// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE inventario SET " . implode(", ", $set) . " WHERE cod_inventario = ?";
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

<meta http-equiv="Refresh" content="1; url='inventario.php'" />
