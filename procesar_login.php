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

// Primero verificamos si el usuario existe sin importar el estado
$sqlExiste = "SELECT id, rol, nombre, estado FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
$stmtExiste = $conexion->prepare($sqlExiste);
$stmtExiste->bind_param("ss", $nombre_usuario, $contrasena);
$stmtExiste->execute();
$stmtExiste->store_result();

if ($stmtExiste->num_rows > 0) {
    $stmtExiste->bind_result($id, $rol, $nombre, $estado);
    $stmtExiste->fetch();
    
    // Si el usuario existe pero está inactivo (estado = 0)
    if ($estado == 0) {
        $mensaje = "Su cuenta está inactiva. Por favor contacte al administrador.";
        $tipo = "error";
        $titulo = "Cuenta inactiva";
        $redireccion = "index.html";
    } else {
        // Si el usuario existe y está activo
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['rol'] = $rol;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['estado'] = $estado;
        
        // Preparo mensaje de éxito y redirección según rol
        $mensaje = "Bienvenido, $nombre!";
        $tipo = "success";
        $titulo = "Acceso correcto";
        
        if ($rol == "Funcionario") {
            $redireccion = "FUNCIONARIO/funcionario.php";
        } elseif ($rol == "Administrador") {
            $redireccion = "ADMINISTRADOR/admin_panel.php";
        } elseif ($rol == "Supervisor") {
            $redireccion = "SUPERVISOR/supervisor.php";
        }
    }
} else {
    // Si el usuario no existe o la contraseña es incorrecta
    $mensaje = "Usuario o contraseña incorrecta, vuelva a intentar.";
    $tipo = "error";
    $titulo = "Error de acceso";
    $redireccion = "index.html";
}

$stmtExiste->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando...</title>
    <!-- Incluir SweetAlert2 desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "<?php echo $titulo; ?>",
                text: "<?php echo $mensaje; ?>",
                icon: "<?php echo $tipo; ?>",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#3085d6"
            }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {
                    window.location.href = "<?php echo $redireccion; ?>";
                }
            });
        });
    </script>
</body>
</html>
