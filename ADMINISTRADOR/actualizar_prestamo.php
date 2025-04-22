<?php
// filepath: c:\xampp\htdocs\proyectofinal\ADMINISTRADOR\actualizar_prestamo.php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtén los datos enviados desde el formulario
$id_prestamo = $_POST['id_prestamo'];
$insumo = $_POST['insumo'];
$nombre_persona_prestamo = $_POST['nombre_persona_prestamo'];
$estado = $_POST['estado'];
$dia_prestamo = $_POST['dia_prestamo'];
$hora_prestamo = $_POST['hora_prestamo'];

// Actualiza el registro en la tabla prestamos_insumos
$sql = "UPDATE prestamos_insumos 
        SET insumo = '$insumo', 
            nombre_persona_prestamo = '$nombre_persona_prestamo', 
            estado = '$estado', 
            dia_prestamo = '$dia_prestamo', 
            hora_prestamo = '$hora_prestamo' 
        WHERE id_prestamo = $id_prestamo";

if ($conexion->query($sql) === TRUE) {
    // Si el estado del préstamo es "Devuelto", actualiza el estado del insumo en la tabla inventario
    if ($estado === "Devuelto") {
        $sql_inventario = "UPDATE inventario 
                           SET estado = 'Libre' 
                           WHERE nom_inventario = '$insumo'";
        $conexion->query($sql_inventario);
    }

    // Redirige de vuelta a la página de préstamos con un mensaje de éxito
    header("Location: prestamos_insumos.php?mensaje=actualizado");
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

// Cierra la conexión
$conexion->close();
?>