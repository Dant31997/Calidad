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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['diahora_p'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $diahora_p = $_GET['diahora_p'];
}
?>    
<style>
    html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
        body{
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
            top: 90%; left:44%;
           
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
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin-left: 60px;       
            border-collapse: collapse; 
        }

        th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
            border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

        td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
            color: #669;    border-top: 1px solid transparent; }

        tr:hover td { background: #d0dafd; color: #339; }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }

        .login-box {
            width: 400px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
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
            margin-top: 1%;
        }
        .btno:hover {
            background-color: #D62828;
        }

        .inputcentrado {
            text-align: center;
        }

</style>
<br>
<div class="login-box">
<h3>Editar Objeto</h3>
<br>
        <form action="cambio_objeto.php" method="POST">
            <div class="form-group">
                <label for="cod_inventario">Cod. Inventario:</label>
                <input class="inputcentrado" type="number" style="width : 50px; heigth : 1px" id="cod_inventario" name="cod_inventario" value="<?php echo $cod_inventario; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="nom_inventario">Nombre del equipo:</label>
                <input type="text" style="width : 200px; heigth : 1px" id="nom_inventario" name="nom_inventario" value="<?php echo $nom_inventario; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="estadoact">Estado Actual:</label>
                <input disabled type="text" style="width : 80px; heigth : 1px" id="estadoact" name="estadoact" value="<?php echo $estado; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" >
                    <option value="libre">Libre</option>
                    <option value="prestado">Prestado</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="nombre_persona">Nombre de la persona:</label>
                <input type="text" style="width : 200px; " id="nombre_persona" name="nombre_persona" value="-">
            </div>
            <br>
            <div class="form-group">
                <label for="devolucion">Fecha de devolucion</label>
                <input type="date" id="devolucion" name="devolucion" value="">
            </div>
            <br>
            <input class="btno" type="submit" name= "editar" value="Editar Objeto">
            <br>
        </form>
        </div>
    <br>
    <a class ="regresar" href="inventario.php">Volver al listado</a>