<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $id = $_GET['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre_usuario'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $nombre_usuario = $_GET['nombre_usuario'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $nombre = $_GET['nombre'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['rol'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $rol = $_GET['rol'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['estado'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $estado = $_GET['estado'];
}

?>
<style>
    html {
        background: linear-gradient(white, 60%, #FADBD8);
        height: 789px;
    }

    h2 {
        text-align: center;
    }

    body {

        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
        margin-left: 5%;
    }

    .pdf-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #E07A5F;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        margin-left: 45%;
    }

    .pdf-button:hover {
        background-color: #D62828;
        margin-left: 45%;
    }

    caption {
        padding: 0.3em;
        color: #fff;
        background: #000;
    }


    .btno {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        border-color: transparent;
        margin-left: 30%;
    }

    h3 {
        margin-left: 30%;
    }

    .regresar {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 92%;
        left: 43%;
    }

    .regresar:hover {
        background-color: #D62828;
    }

    .button-container {
        display: inline-block;
        /* Mantiene los botones en la misma línea */
    }

    .custom-button {
        padding: 10px 20px;
        background-color: #0074D9;
        color: #fff;
        border: none;
        border-radius: 5px;
        margin-right: 1px;
        /* Espacio entre los botones */
        text-decoration: none;
        margin-left: 200px;

    }

    .custom-button:last-child {
        margin-right: 0;
        /* Elimina el margen derecho del último botón */
    }

    .login-box {
        width: 350px;
        position: absolute;
        top: 2%;
        left: 35%;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        /* Ajusta el valor para cambiar la curvatura de las esquinas */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
        font-weight: 500;
    }

    .form-group input[type="text"],
    .form-group select {
        width: 100%;
        max-width: 300px;
        padding: 8px 12px;
        border: 2px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .form-group input[type="text"]:focus,
    .form-group select:focus {
        border-color: #0074D9;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 116, 217, 0.2);
    }

    .form-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 35px;
    }

    .form-group input[disabled] {
        background-color: #f5f5f5;
        border-color: #ddd;
        cursor: not-allowed;
    }

    

</style>

<!-- Formulario para editar un usuario existente -->
<br>
<div class="login-box">
    <h3>Editar Usuario</h3>
    <br>
    <form action="editar_usuario.php" method="POST">
            <input hidden type="text" style="width : 50px; heigth : 1px" class="inputcentrado" id="usuario_id" name="usuario_id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="nuevo_usuario">Nombre de Usuario:</label>
            <input type="text" id="nuevo_usuario" name="nuevo_usuario" value="<?php echo $nombre_usuario; ?>">
        </div>
        <div class="form-group">
            <label for="nuevo_nombre">Nombre Completo:</label>
            <input type="text" id="nuevo_nombre" name="nuevo_nombre" value="<?php echo $nombre; ?>">
        </div>
        <div class="form-group">
            <label for="nuevo_rol">Nuevo Rol:</label>
            <select id="nuevo_rol" name="nuevo_rol">
                <option value="Funcionario" <?php echo ($rol == 'Funcionario' ? 'selected' : ''); ?>>Funcionario</option>
                <option value="Administrador" <?php echo ($rol == 'Administrador' ? 'selected' : ''); ?>>Administrador</option>
                <option value="Supervisor" <?php echo ($rol == 'Supervisor' ? 'selected' : ''); ?>>Supervisor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="1" <?php echo ($estado == '1' ? 'selected' : ''); ?>>Activo</option>
                <option value="0" <?php echo ($estado == '0' ? 'selected' : ''); ?>>Inactivo</option>
            </select>
        </div>
        <input class="btno" type="submit" name="editar" value="Editar Usuario">
    </form>
</div>
<br>
<a class="regresar" href="listar_usuarios.php">Volver al listado</a>