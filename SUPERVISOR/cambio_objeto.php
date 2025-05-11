<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>
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
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Campos actualizados correctamente.',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'inventario.php';
                }
            });
        </script>";
    }
} catch (mysqli_sql_exception $e) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    if ($e->getCode() == 1062) { // Código de error para "Duplicate entry"
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El objeto ya existe en el inventario.',
                confirmButtonText: 'Volver'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar el objeto de inventario: " . $e->getMessage() . "',
                confirmButtonText: 'Aceptar'
            });
        </script>";
    }
}

// Cierra la conexión
$conexion->close();
?>
