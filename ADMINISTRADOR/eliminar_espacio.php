<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cod_espacio'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $cod_espacio = $_GET['cod_espacio'];

    // Consulta SQL para eliminar el usuario por ID
    $sql = "DELETE FROM espacios WHERE cod_espacio = $cod_espacio";

    if ($conexion->query($sql) === TRUE) {
        header("Location: espacios.php");
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID de usuario no especificado.";
}
?>