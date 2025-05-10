<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
</html>
<?php
try {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        throw new Exception("Error en la conexión: " . $conexion->connect_error);
    }

    // Obtiene los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $nuevo_usuario = $_POST['nuevo_usuario'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_rol = $_POST['nuevo_rol'];
    $estado = $_POST['estado'];

    // Validaciones
    if (empty($usuario_id)) {
        throw new Exception("ID de usuario no válido");
    }

    // Inicializa la parte SET de la consulta SQL
    $set = array();
    $tipos = "";
    $valores = array();

    if (!empty($nuevo_usuario)) {
        $set[] = "nombre_usuario = ?";
        $tipos .= 's';
        $valores[] = $nuevo_usuario;
    }
    if (!empty($nuevo_nombre)) {
        $set[] = "nombre = ?";
        $tipos .= 's';
        $valores[] = $nuevo_nombre;
    }
    if (!empty($nuevo_rol)) {
        $set[] = "rol = ?";
        $tipos .= 's';
        $valores[] = $nuevo_rol;
    }
    if (isset($estado)) {
        $set[] = "estado = ?";
        $tipos .= 'i';
        $valores[] = $estado;
    }

    if (empty($set)) {
        throw new Exception("No hay campos para actualizar");
    }

    // Consulta SQL para actualizar los campos especificados
    $sql = "UPDATE usuarios SET " . implode(", ", $set) . " WHERE id = ?";
    $tipos .= 'i';
    $valores[] = $usuario_id;

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param($tipos, ...$valores);

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    // Si todo sale bien, muestra mensaje de éxito
    ?>
    <script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'Usuario actualizado correctamente',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'listar_usuarios.php';
            }
        });
    </script>
    <?php

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
