<?php
function verificarSesion($rol_requerido = null) {
    // Verificar si la sesión existe
    if (!isset($_SESSION['id']) || !isset($_SESSION['rol']) || !isset($_SESSION['estado'])) {
        // Redireccionar al login si no hay sesión activa
        header("Location: ../index.php");
        exit();
    }
    
    // Verificar si el usuario está activo
    if ($_SESSION['estado'] != 1) {
        // Usuario inactivo
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
    
    
    // Verificar el rol (opcional)
    if ($rol_requerido !== null && $_SESSION['rol'] != $rol_requerido) {
        // Rol incorrecto, redirigir según el rol actual
        if ($_SESSION['rol'] == "Funcionario") {
            header("Location: FUNCIONARIO/funcionario.php");
        } elseif ($_SESSION['rol'] == "Administrador") {
            header("Location: ADMINISTRADOR/admin_panel.php");
        } elseif ($_SESSION['rol'] == "Supervisor") {
            header("Location: SUPERVISOR/supervisor.php");
        }
        exit();
    }    
    return true;
}
?>