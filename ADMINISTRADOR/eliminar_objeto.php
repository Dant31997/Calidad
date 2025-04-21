<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cod_inventario'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $cod_inventario = $_GET['cod_inventario'];

    // Consulta SQL para eliminar el usuario por ID
    $sql = "DELETE FROM inventario WHERE cod_inventario = $cod_inventario";

    if ($conexion->query($sql) === TRUE) {
        header("Location: inventario.php");
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID de usuario no especificado.";
}
?>