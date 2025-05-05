<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cod_espacio'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $cod_espacio = $_GET['cod_espacio'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nom_espacio'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $nom_espacio = $_GET['nom_espacio'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['capacidad'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $capacidad = $_GET['capacidad'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['estado_espacio'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $estado_espacio = $_GET['estado_espacio'];
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        left: 45%;

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

    th {
        text-align: center;
    }

    tr {
        text-align: center;
    }

    table {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;
        margin-left: 60px;
        border-collapse: collapse;
    }

    th {
        font-size: 13px;
        font-weight: normal;
        padding: 8px;
        background: #b9c9fe;
        border-top: 4px solid #aabcfe;
        border-bottom: 1px solid #fff;
        color: #039;
    }

    td {
        padding: 8px;
        background: #e8edff;
        border-bottom: 1px solid #fff;
        color: #669;
        border-top: 1px solid transparent;
    }

    tr:hover td {
        background: #d0dafd;
        color: #339;
    }

    .title1 {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    }

    .login-box {
        width: 320px;
        height: 470px;
        margin: 10px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    input[type="text"],
    input[type="number"],
    input[type="textarea"],
    select {
        width: 100%;
        /* Ajusta el ancho al 100% del contenedor */
        padding: 5px;
        /* Espaciado interno */
        display: inline-block;
        /* Asegura que se comporten como elementos en línea */
        border: 1px solid #ccc;
        /* Borde gris claro */
        border-radius: 5px;
        /* Bordes redondeados */
        box-sizing: border-box;
        /* Incluye el padding y el borde en el ancho total */
        font-size: 14px;
        /* Tamaño de fuente */
        font-family: Arial, sans-serif;
        /* Fuente consistente */
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="textarea"]:focus,
    select:focus {
        border-color: #D62828;
        /* Cambia el color del borde al enfocarse */
        outline: none;
        /* Elimina el contorno predeterminado */
        box-shadow: 0 0 5px rgba(214, 40, 40, 0.5);
        /* Agrega un efecto de sombra */
    }

    label {
        font-weight: bold;
        /* Resalta los labels */
        display: block;
        /* Asegura que los labels estén encima de los inputs */
        margin-bottom: 5px;
        /* Espaciado entre el label y el input */
    }

    .btno {
        display: inline-block;
        padding: 10px 20px;
        background-color: red;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        margin-left: 30%;
        cursor: pointer;
        /* Cambia el cursor al pasar sobre el botón */
        border-color: transparent;
    }

    .btno:hover {
        background-color: #D62828;
    }

    input .hidden {
        display: none;
    }
</style>
<br>
<div class="login-box">
    <h1>Editar Espacio</h1>
    <br>
    <form action="cambio_espacio.php" method="POST">

        <input type="hidden" id="cod_espacio" name="cod_espacio" value="<?php echo $cod_espacio; ?>">

        <br>
        <div class="form-group">
            <label for="nom_espacio">Nombre del espacio:</label>
            <input type="text" id="nom_espacio" name="nom_espacio" value="<?php echo $nom_espacio; ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="Descripcion">Descripción:</label>
            <textarea id="Descripcion" name="Descripcion" rows="4" cols="40"><?php echo $Descripcion; ?></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="text" id="capacidad" name="capacidad" value="<?php echo $capacidad; ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="estado_espacio">Estado:</label>
            <select id="estado_espacio" name="estado_espacio">
                <option value="libre" <?php echo ($estado_espacio == 'libre') ? 'selected' : ''; ?>>Libre</option>
                <option value="ocupado" <?php echo ($estado_espacio == 'ocupado') ? 'selected' : ''; ?>>Ocupado</option>
            </select>
        </div>
        <br>
        <input class="btno" type="submit" name="editar" value="Editar Espacio">
    </form>
</div>
<br>
<a class="regresar" href="espacios.php">Volver al listado</a>