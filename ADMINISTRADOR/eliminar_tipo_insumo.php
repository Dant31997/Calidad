<?php
// filepath: c:\Users\Familia\Documents\GitHub\Calidad\ADMINISTRADOR\eliminar_tipo_insumo.php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Verifica si se recibió el id_insumo por el método GET
if (isset($_GET['id_insumo'])) {
    $id_insumo = intval($_GET['id_insumo']); // Asegúrate de convertirlo a entero para evitar inyecciones SQL

    // Consulta para eliminar el registro
    $sql = "DELETE FROM tipo_insumo WHERE id_insumo = $id_insumo";

    if ($conexion->query($sql) === TRUE) {
        // Redirige de vuelta a tipo_insumo.php con un mensaje de éxito
        header("Location: tipo_insumo.php?mensaje=eliminado");
    } else {
        // Redirige de vuelta a tipo_insumo.php con un mensaje de error
        header("Location: tipo_insumo.php?mensaje=error");
    }
} else {
    // Si no se recibió el id_insumo, redirige de vuelta con un mensaje de error
    header("Location: tipo_insumo.php?mensaje=sin_id");
}

// Cierra la conexión
$conexion->close();
?>