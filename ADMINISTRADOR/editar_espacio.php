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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['persona_encargada'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $persona_encargada = $_GET['persona_encargada'];
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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['dh_espacio'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $dh_espacio = $_GET['dh_espacio'];
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['dh_regreso'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $dh_regreso = $_GET['dh_regreso'];
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
            top: 80%; left:44%;
           
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
<h3>Editar Espacio</h3>
<br>
        <form action="cambio_espacio.php" method="POST">
            <div class="form-group">
                <label for="cod_espacio">Cod. Espacio:</label>
                <input class="inputcentrado" type="number" style="width : 50px; heigth : 1px" id="cod_espacio" name="cod_espacio" value="<?php echo $cod_espacio; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="nom_espacio">Nombre del espacio:</label>
                <input type="text" id="nom_espacio" name="nom_espacio" value="<?php echo $nom_espacio; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="persona_encargada">Nombre del responsable:</label>
                <input type="text" style="width : 200px; heigth : 1px" id="persona_encargada" name="persona_encargada" value="<?php echo $persona_encargada; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="estadoact">Estado Actual:</label>
                <input disabled type="text" style="width : 80px; heigth : 1px" id="estadoact" name="estadoact" value="<?php echo $estado_espacio; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="estado_espacio">Estado:</label>
                <select id="estado_espacio" name="estado_espacio" >
                    <option value="libre">Libre</option>
                    <option value="ocupado">Ocupado</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="dia_uso">Dia de prestamo:</label>
                <select id="dia_uso" name="dia_uso">
                    <option value="-">-</option>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miercoles">Miercoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                    <option value="sabado">Sabado</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="dh_regreso">Horario de uso:</label>
                <input type="text" id="dh_regreso" name="dh_regreso" value="-">
            </div>
            <br>
            <input class="btno" type="submit" name= "editar" value="Editar Espacio">
        </form>
        </div>
    <br>
    <a class ="regresar" href="espacios.php">Volver al listado</a>