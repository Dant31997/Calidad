<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del formulario
$cod_espacio = $_POST['cod_espacio'];
$nom_espacio = $_POST['nom_espacio'];
$estado_espacio = $_POST['estado_espacio'];
$persona_encargada = ($_POST['estado_espacio'] == 'ocupado') ? $persona_encargada = $_POST['persona_encargada'] : "-";
$dia_uso = $_POST['dia_uso'];
$fecha_regreso = $_POST['dh_regreso'];

// Inicializa la parte SET de la consulta SQL
$set = array();
$tipos = "";
$valores = array();

if (!empty($nom_espacio)) {
    $set[] = "nom_espacio = ?";
    $tipos .= 's';
    $valores[] = $nom_espacio;
}

if (!empty($persona_encargada)){
    $set[] = "persona_encargada = ?";
    $tipos .= 's';
    $valores[] = $persona_encargada;
}

if (!empty($estado_espacio)) {
    $set[] = "estado_espacio = ?";
    $tipos .= 's';
    $valores[] = $estado_espacio;
}

if (!empty($dia_uso)) {
    $set[] = "dh_espacio = ?";
    $tipos .= 's';
    $valores[] = $dia_uso;
} else {
    $set[] = "dh_espacio = ?";
    $tipos .= 's';
    $valores[] = "-";
}

if (!empty($fecha_regreso)) {
    $set[] = "dh_regreso = ?";
    $tipos .= 's';
    $valores[] = $fecha_regreso;
} else {
    $set[] = "dh_regreso = ?";
    $tipos .= 's';
    $valores[] = "-";
}

// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE espacios SET " . implode(", ", $set) . " WHERE cod_espacio = ?";
$tipos .= 'i'; // Agrega el tipo de dato para el ID
$valores[] = $cod_espacio;

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

<meta http-equiv="Refresh" content="1; url='espacios.php'" />