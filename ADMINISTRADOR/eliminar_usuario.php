<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
</html>

<?php
try {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "basededatos");

        // Verifica la conexión
        if ($conexion->connect_error) {
            throw new Exception("Error en la conexión: " . $conexion->connect_error);
        }

        $id = $_GET['id'];

        // Usar consulta preparada para mayor seguridad
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar el usuario: " . $stmt->error);
        }

        ?>
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'Usuario eliminado correctamente',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'listar_usuarios.php';
                }
            });
        </script>
        <?php

    } else {
        throw new Exception("ID de usuario no especificado.");
    }

} catch (Exception $e) {
    ?>
    <script>
        Swal.fire({
            title: 'Error',
            text: '<?php echo $e->getMessage(); ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'listar_usuarios.php';
            }
        });
    </script>
    <?php
} finally {
    // Cierra la conexión si existe
    if (isset($conexion)) {
        $conexion->close();
    }
}
?>
