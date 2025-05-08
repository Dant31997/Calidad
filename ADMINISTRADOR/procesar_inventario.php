<?php
// Iniciar sesión si es necesario para mantener datos de usuario
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Recuperar los parámetros necesarios
$idPrestamo = $_POST['idPrestamo'];
$nombrePersona = $_POST['nombrePersona'];

// Variables para el mensaje de alerta
$mensaje = "";
$tipo = ""; // success, error, warning, info
$titulo = "";

// Verificar si tenemos los equipos seleccionados
if (isset($_POST['equipos']) && is_array($_POST['equipos']) && count($_POST['equipos']) > 0) {
    
    // Preparar la consulta SQL para actualizar múltiples registros
    $stmt = $conexion->prepare("UPDATE inventario 
                              SET id_prestamo = ?,
                                    estado = 'Prestado', 
                                  prestado_a = ?, 
                                  dia_prestamo = CURRENT_TIMESTAMP 
                              WHERE cod_inventario = ?");
    
    // Verificar que la preparación fue exitosa
    if ($stmt) {
        // Contador de equipos actualizados
        $equiposActualizados = 0;
        
        // Iterar sobre cada equipo seleccionado
        foreach ($_POST['equipos'] as $codInventario) {
            // Vincular parámetros y ejecutar
            $stmt->bind_param("iss", $idPrestamo, $nombrePersona, $codInventario);
            
            if ($stmt->execute()) {
                $equiposActualizados++;
            }
        }
        
        // Cerrar el statement
        $stmt->close();
        
        // Verificar si se actualizaron equipos
        if ($equiposActualizados > 0) {
            // Actualizar la tabla prestamos_insumos
            $stmtPrestamo = $conexion->prepare("UPDATE prestamos_insumos 
                                               SET estado_equipos = 'Asignado' 
                                               WHERE id_prestamo = ?");
            
            if ($stmtPrestamo) {
                $stmtPrestamo->bind_param("s", $idPrestamo);
                
                if ($stmtPrestamo->execute()) {
                    // Mensaje de éxito completo
                    $titulo = "¡Operación Exitosa!";
                    $mensaje = "Se han asignado $equiposActualizados equipos y actualizado el estado del préstamo exitosamente.";
                    $tipo = "success";
                } else {
                    // Se actualizaron los equipos pero no el estado del préstamo
                    $titulo = "Advertencia";
                    $mensaje = "Se han asignado los equipos pero no se pudo actualizar el estado del préstamo.";
                    $tipo = "warning";
                }
                
                $stmtPrestamo->close();
            } else {
                // Error en la preparación de la segunda consulta
                $titulo = "Advertencia";
                $mensaje = "Se han asignado los equipos pero hubo un error al preparar la actualización del préstamo.";
                $tipo = "warning";
            }
        } else {
            // No se actualizó ningún equipo
            $titulo = "Advertencia";
            $mensaje = "No se pudo asignar ningún equipo.";
            $tipo = "warning";
        }
    } else {
        // Error en la preparación de la consulta
        $titulo = "Error";
        $mensaje = "Error al preparar la consulta: " . $conexion->error;
        $tipo = "error";
    }
} else {
    // No hay equipos seleccionados
    $titulo = "Advertencia";
    $mensaje = "No se seleccionaron equipos para asignar.";
    $tipo = "warning";
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando...</title>
    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '<?php echo $titulo; ?>',
                text: '<?php echo $mensaje; ?>',
                icon: '<?php echo $tipo; ?>',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#d33'
            }).then((result) => {
                // Redirigir después de cerrar el alert
                window.location.href = 'asignar_inventario.php';
            });
        });
    </script>
</body>
</html>