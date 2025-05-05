<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtén los datos enviados desde el formulario
$id_prestamo_espacio = $_POST['id_prestamo_espacio'];
$espacio = $_POST['espacio'];
$nom_persona = $_POST['nom_persona'];
$estado = $_POST['estado'];
$fecha_entrega = $_POST['fecha_entrega'];

// Actualiza el registro en la tabla prestamos_espacios
$sql = "UPDATE prestamos_espacios 
        SET espacio = '$espacio', 
            nom_persona = '$nom_persona', 
            estado = '$estado',  
            fecha_entrega = '$fecha_entrega'
        WHERE id_prestamo_espacio = $id_prestamo_espacio";

if ($conexion->query($sql) === TRUE) {
    // Si el estado del préstamo es "Cancelado", puedes realizar acciones adicionales aquí si es necesario
    if ($estado === "Cancelado" || $estado === "Terminado") {
        $sql_espacios = "UPDATE espacios 
                         SET estado_espacio = 'Libre' 
                         WHERE nom_espacio = '$espacio'";
        $conexion->query($sql_espacios);
    }

    // Redirige de vuelta a la página de préstamos con un mensaje de éxito
    header("Location: prestamos_insumos.php?mensaje=actualizado");
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

// Cierra la conexión
$conexion->close();
?>