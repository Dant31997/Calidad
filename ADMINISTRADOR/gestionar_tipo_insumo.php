<head>
    <!-- ...existing code... -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ...existing code... -->
</head>
<?php
$conexion = new mysqli("localhost", "root", "", "basededatos");

        // Verificar conexión
        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }
// Procesar actualización si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $id_insumo = $_POST['id_insumo'];
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_nivel = $_POST['nivel_acceso'];

    // Preparar y ejecutar la actualización
    $stmt = $conexion->prepare("UPDATE tipo_insumo SET nombre_insumo = ?, nivel_insumo = ? WHERE id_insumo = ?");
    $stmt->bind_param("sii", $nuevo_nombre, $nuevo_nivel, $id_insumo);

    if ($stmt->execute()) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'El tipo de insumo se actualizó correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = 'tipo_insumo.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar el tipo de insumo.',
                    confirmButtonColor: '#d33'
                });
            });
        </script>";
    }
    $stmt->close();
}
?>