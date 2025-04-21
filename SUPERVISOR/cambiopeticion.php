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
$diaentrega = $_POST['diaentrega'];
$devolucion = $_POST['devolucion'];
$horario = $_POST['horario'];

// Inicializa la parte SET de la consulta SQL
$set = array();
$tipos = "";
$valores = array();

if (!empty($nom_inventario)) {
    $set[] = "equipo = ?";
    $tipos .= 's';
    $valores[] = $nom_inventario;
}

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

if (!empty($diaentrega)) {
    $set[] = "dia_entrega = ?";
    $tipos .= 's';
    $valores[] = $diaentrega;
}

if (!empty($devolucion)) {
    $set[] = "devolucion = ?";
    $tipos .= 's';
    $valores[] = $devolucion;
} 

if (!empty($horario)) {
    $set[] = "hoario_prestamo = ?";
    $tipos .= "s";
    $valores[] = $horario;
}

// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE peticiones_estudiantes SET " . implode(", ", $set) . " WHERE id = ?";
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

<meta http-equiv="Refresh" content="1; url='verificarpeticiones.php'" />
