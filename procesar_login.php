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

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT id, rol, nombre FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $nombre_usuario, $contrasena);
$stmt->execute();
$stmt->store_result();


// Verifica si se encontró un usuario
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $rol, $nombre);
    $stmt->fetch();
    
    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['rol'] = $rol;
    $_SESSION['nombre'] = $nombre;
    
    // Redirige al usuario según su rol
    if ($rol == "Funcionario") {
        header("Location: FUNCIONARIO/funcionario.php?nombre=$nombre");
    }  elseif ($rol == "Administrador") {
        header("Location: ADMINISTRADOR/admin_panel.php?nombre=$nombre");
    } elseif ($rol == "Supervisor") {
        header("Location: SUPERVISOR/supervisor.php");
    }
} else {
    echo " ";
}
//$stmt->close();
//$conexion->close();   
?>  
<meta http-equiv="Refresh" content="0; url='index.html'" />
<script>alert("Usuario o contraseña incorrecta, vuelva a intentar.");</script>