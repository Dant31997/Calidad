<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cod_inventario'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $cod_inventario = $_GET['cod_inventario'];
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    global $nombre_sup;
    $nombre_sup = $_GET['nombre'];
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nom_inventario'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $nom_inventario = $_GET['nom_inventario'];
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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Descripcion'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    $Descripcion = $_GET['Descripcion'];
}
?>
<style>
    html {
        background: linear-gradient(to bottom, white, 70%, #FADBD8);
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    body {
        font-family: Arial, sans-serif;

    }

    .regresar {
        display: inline-block;
        padding: 10px 20px;
        background-color: red;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 90%;
        left: 46%;

    }

    .regresar:hover {
        background-color: #D62828;
    }

    .custom-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: red;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        margin-left: 35%;
    }

    .custom-button:hover {
        background-color: #D62828;
    }

    .title1 {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    }

    .login-box {
        width: 400px;
        height: 480px;
        position: absolute;
        top: 5%;
        left: 35%;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
    }

    .btno {
        display: inline-block;
        padding: 10px 20px;
        background-color: red;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 88%;
        left: 35%;
        border-color: transparent;
    }

    .btno:hover {
        background-color: #D62828;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        .login-box {
            width: 90%;
            padding: 20px;
        }

        .form-group input,
        .form-group select {
            font-size: 16px;
            /* Mejor para móviles */
        }
    }

    .form-group {
        margin-bottom: 2PX;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        color: #333;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #ff4444;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(255, 68, 68, 0.1);
        outline: none;
    }

    .form-group input:disabled {
        background-color: #f1f1f1;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .form-group input[type="number"] {
        -moz-appearance: textfield;
    }

    .form-group input[type="number"]::-webkit-outer-spin-button,
    .form-group input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .form-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% - 1rem) center;
        padding-right: 2.5rem;
    }

    .inputcentrado {
        text-align: center;
    }

    /* Eliminar los atributos de estilo en línea del HTML y usar estas clases */
    .input-small {
        max-width: 100px;
    }

    .input-medium {
        max-width: 200px;
    }

    .input-large {
        width: 100%;
    }

    .textarea-field {
        width: 100%;
        min-height: 120px;
        padding: 0.75rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        color: #333;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        font-family: inherit;
        line-height: 1.5;
        resize: vertical;
    }

    .textarea-field:focus {
        border-color: #ff4444;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(255, 68, 68, 0.1);
        outline: none;
    }

    .textarea-field:disabled {
        background-color: #f1f1f1;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Estilo para el scrollbar del textarea */
    .textarea-field::-webkit-scrollbar {
        width: 8px;
    }

    .textarea-field::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .textarea-field::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .textarea-field::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<br>
<div class="login-box">
    <h3>Editar Insumo</h3>
    <br>
    <form action="cambio_objeto.php" method="POST">

        <input hidden class="inputcentrado" type="number" style="width : 50px; heigth : 1px" id="cod_inventario" name="cod_inventario" value="<?php echo $cod_inventario; ?>">
        <div class="form-group">
            <label for="nom_inventario">Tipo de insumo:</label>
            <input readonly type="text" style="width : 200px; heigth : 1px" id="nom_inventario" name="nom_inventario" value="<?php echo $nom_inventario; ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="Descripcion">Descripcion:</label>
            <textarea class="textarea-field" id="Descripcion" name="Descripcion"><?php echo $Descripcion; ?></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="estado">Estado actual:</label>
            <select id="estado" name="estado" class="select-field">
                <option value="libre" <?php echo ($estado == 'libre') ? 'selected' : ''; ?>>Libre</option>
                <option value="prestado" <?php echo ($estado == 'prestado') ? 'selected' : ''; ?>>Prestado</option>
            </select>
        </div>
        <br>
        <br>
        <input class="btno" type="submit" name="editar" value="Editar Insumo">
        <br>
    </form>
</div>
<br>
<a class="regresar" href="inventario.php">Volver al listado</a>