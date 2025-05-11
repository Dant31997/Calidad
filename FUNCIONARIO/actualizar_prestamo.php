<?php
// Inicia la sesión para poder pasar mensajes entre páginas
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    $_SESSION['alert_type'] = 'error';
    $_SESSION['alert_message'] = "Error en la conexión: " . $conexion->connect_error;
    header("Location: prestamos_insumos.php");
    exit();
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

    // Guarda mensaje de éxito en la sesión
    $_SESSION['alert_type'] = 'success';
    $_SESSION['alert_message'] = 'El préstamo ha sido devuelto correctamente';
    
    // Redirige de vuelta a la página de préstamos
    header("Location: prestamos_insumos.php");
    exit();
} else {
    // Guarda mensaje de error en la sesión
    $_SESSION['alert_type'] = 'error';
    $_SESSION['alert_message'] = "Error al actualizar el registro: " . $conexion->error;
    
    // Redirige de vuelta a la página de préstamos
    header("Location: prestamos_insumos.php");
    exit();
}

// Cierra la conexión
$conexion->close();