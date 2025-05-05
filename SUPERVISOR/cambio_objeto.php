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
$Descripcion = $_POST['Descripcion'];
$estado = $_POST['estado'];

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

if (!empty($Descripcion)) {
    $set[] = "Descripcion = ?";
    $tipos .= 's';
    $valores[] = $Descripcion;
}

// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE inventario SET " . implode(", ", $set) . " WHERE cod_inventario = ?";
$tipos .= 'i'; // Agrega el tipo de dato para el ID
$valores[] = $cod_inventario;

$stmt = $conexion->prepare($sql);
$stmt->bind_param($tipos, ...$valores);

try { 
if ($stmt->execute()) {
    echo "Campos actualizados correctamente.";
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) { // Código de error para "Duplicate entry"
        echo "<script>alert('Error: El objeto ya existe en el inventario.');
        window.history.back();
        </script>";
        
    } else {
        echo "Error al actualizar el objeto de inventario: " . $e->getMessage();
    }
}
    

// Cierra la conexión
$conexion->close();
?>

<meta http-equiv="Refresh" content="1; url='inventario.php'" />
