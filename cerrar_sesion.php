<?php
// Iniciar o reanudar la sesión
session_start();

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión actual
session_destroy();

// Redirigir a la página de inicio de sesión
header("Location: ../index.php");
exit();
?>
