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
?>    
<style>

html{
            background: linear-gradient(white,60%,#FADBD8 );height:789px; 
        }
        h2{
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
            margin-left: 40%;
        }
        h3 {
            margin-left: 40%;
        }
        .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 45%;
        }
        .regresar:hover {
            background-color: #D62828;
            margin-left: 45%;
        }
        .button-container {
            display: inline-block; /* Mantiene los botones en la misma línea */
        }

        .custom-button {
            padding: 10px 20px;
            background-color: #0074D9;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-right: 1px; /* Espacio entre los botones */
            text-decoration: none;
            margin-left: 200px;
            
        }

        .custom-button:last-child {
            margin-right: 0; /* Elimina el margen derecho del último botón */
        }

        .login-box {
            width: 400px;
            margin: 60px auto;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .inputcentrado {
            text-align: center;
        }
    </style>

<!-- Formulario para editar un usuario existente -->
<br>
<div class="login-box">


<h3>Editar Usuario</h3>
<br>
        <form action="editar_usuario.php" method="POST">
            <div class="form-group">
                <input hidden type="text" style="width : 50px; heigth : 1px" class="inputcentrado" id="usuario_id" name="usuario_id" value="<?php echo $id; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_usuario">Nombre de Usuario:</label>
                <input type="text" id="nuevo_usuario" name="nuevo_usuario" value="<?php echo $nombre_usuario; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_nombre">Nombre Completo:</label>
                <input type="text" style="width : 200px; heigth : 1px" id="nuevo_nombre" name="nuevo_nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="form-group">
                <label for="rolact">Rol Actual:</label>
                <input disabled type="text" style="width : 100px; heigth : 1px" id="rolact" name="rolact" value="<?php echo $rol; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_rol">Nuevo Rol:</label>
                <select id="nuevo_rol" name="nuevo_rol" >
                    <option value="Funcionario">Funcionario</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Supervisor">Supervisor</option>  
                </select>
            </div>
            <input class="btno" type="submit" name= "editar" value="Editar Usuario">
        </form>
        </div>
    <br>
    <a class ="regresar" href="listar_usuarios.php">Volver al listado</a>