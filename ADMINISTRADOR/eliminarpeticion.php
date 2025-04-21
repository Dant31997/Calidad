<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $id = $_GET['id'];

    // Consulta SQL para eliminar el usuario por ID
    $sql = "DELETE FROM peticiones_estudiantes WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: http://localhost/proyecto/verificarpeticiones.php");
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID de peticion no especificado.";
}
?>