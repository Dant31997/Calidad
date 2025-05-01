<html>

<head>
    <head>
        <meta charset="UTF-8">
        <title>Crear Usuario</title>
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    </head>

</html>
<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];


try {
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, nombre, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $nombre_usuario, $contrasena, $nombre, $rol);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Usuario creado correctamente',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                timer: 4000
            }).then(() => {
                window.location.href = 'admin_panel.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se puede crear este usuario',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
    $stmt->close();
    $conexion->close();
} catch (mysqli_sql_exception $e) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'Nombre de usuario ya usado, vuelva a intentar.',
            confirmButtonColor: '#d33'
        });
    </script>";
}
?>