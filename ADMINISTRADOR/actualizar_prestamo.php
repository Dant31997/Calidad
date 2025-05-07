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
$estado = "Devuelto";


// Actualiza el registro en la tabla prestamos_insumos
$sql = "UPDATE prestamos_insumos 
        SET estado = '$estado', fecha_devolucion = NOW()
        WHERE id_prestamo = $id_prestamo";

if ($conexion->query($sql) === TRUE) {
    // Si el estado del préstamo es "Devuelto", actualiza el estado del insumo en la tabla inventario
    if ($estado === "Devuelto") {
        $sql_inventario = "UPDATE inventario 
                           SET estado = 'Libre', prestado_a = 'Nadie', dia_prestamo = NULL, id_prestamo = NULL
                           WHERE id_prestamo = '$id_prestamo'";
        $conexion->query($sql_inventario);
    }

    // Redirige de vuelta a la página de préstamos con un mensaje de éxito
    header("Location: prestamos_insumos.php?mensaje=actualizado");
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

// Cierra la conexión
$conexion->close();
