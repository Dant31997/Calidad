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
$idPrestamo = isset($_POST['idPrestamo']) ? (int)$_POST['idPrestamo'] : 0;
$nombrePersona = isset($_POST['nombrePersona']) ? trim($_POST['nombrePersona']) : '';

// Variables para el mensaje de alerta
$mensaje = "";
$tipo = ""; // success, error, warning, info
$titulo = "";

// Verificar si tenemos los equipos seleccionados y parámetros válidos
if (isset($_POST['equipos']) && is_array($_POST['equipos']) && count($_POST['equipos']) > 0 && $idPrestamo > 0 && !empty($nombrePersona)) {

    // Iniciar transacción para asegurar consistencia
    $conexion->begin_transaction();

    try {
        // Preparar la consulta SQL para actualizar múltiples registros
        $stmt = $conexion->prepare("UPDATE inventario 
                                  SET id_prestamo = ?,
                                      estado = 'Prestado', 
                                      prestado_a = ?
                                  WHERE cod_inventario = ?");

        // Verificar que la preparación fue exitosa
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        // Contador de equipos actualizados
        $equiposActualizados = 0;

        // Iterar sobre cada equipo seleccionado
        foreach ($_POST['equipos'] as $codInventario) {
            // Sanitizar el código de inventario
            $codInventario = trim($codInventario);

            // Vincular parámetros y ejecutar
            $stmt->bind_param("iss", $idPrestamo, $nombrePersona, $codInventario);

            if ($stmt->execute()) {
                $equiposActualizados++;
            } else {
                throw new Exception("Error al actualizar el equipo $codInventario: " . $stmt->error);
            }
        }

        // Cerrar el statement
        $stmt->close();

        // Si todo está bien, confirmar la transacción
        $conexion->commit();

        // Mensaje de éxito completo
        $titulo = "¡Operación Exitosa!";
        $mensaje = "Se han asignado $equiposActualizados equipos y actualizado el estado del préstamo exitosamente.";
        $tipo = "success";
    } catch (Exception $e) {
        // Revertir cambios en caso de error
        $conexion->rollback();

        $titulo = "Error";
        $mensaje = $e->getMessage();
        $tipo = "error";
    }
} else {
    // Datos insuficientes o inválidos
    $titulo = "Advertencia";
    if (!isset($_POST['equipos']) || !is_array($_POST['equipos']) || count($_POST['equipos']) == 0) {
        $mensaje = "No se seleccionaron equipos para asignar.";
    } else if ($idPrestamo <= 0) {
        $mensaje = "ID de préstamo inválido.";
    } else {
        $mensaje = "Nombre de persona inválido.";
    }
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
                window.location.href = 'verificarPeticionesInsumos.php';
            });
        });
    </script>
</body>

</html>