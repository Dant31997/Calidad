<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    global $nombre_admin;
    $nombre_admin = $_GET['nombre'];
}
?>

<html>
<head>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Panel de Administrador</title>

<style>
            html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            margin-bottom: 48%;
        }
        
        .form-group {
            margin-bottom: 20px;

        }
        .logout-button {
            background-color: #ff0000;
            color: white;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            position: absolute;
            top: 20px; left: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logout-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .panel-box {
            max-width: 800px;
            height: 320px;
            position: absolute;
            top: 25%; left:39%;
            padding: 20px;
            width: 350px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .panel-box-admin {
            width: 390px;
            height: 65px;
            position: absolute;
            top: 5%; left:39%;
            background-color: red;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .lista {
            background-color: #ff0000;
            color: #fff;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            position: absolute;
            top: 82%; left: 33%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .lista:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .crear_usu {
            background-color: #ff0000;
            color: #fff;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            position: absolute;
            top: 68%; left: 35%;
        }

        .crear_usu:hover {
            background-color: #D62828;
        }
        h2 {
            color:white;
            text-align: center;
        }

        h3 {
            text-align: center;
        }   

        .custom-button  {
                padding: 10px 20px;
                background-color: red;
                color: #fff;
                border: none;
                width: 295px;
                height: 50px;
                border-radius: 5px;
                text-decoration: none;
                position: absolute;
                top: 39%; left: 7% ;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

        .custom-button2 {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            text-align: center;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 82%; left: 7% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button2:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

    
        .custom-button3 {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 58.5%; left: 73% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button3:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

        .custom-button4 {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 68%; left: 73% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button4:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

        .custom-button5 {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 78%; left: 73% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button5:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

        .rol{
            left: 50%;}
           

        .imginv {
            position: absolute;
            top: 4%; left:11%;
        }
        .imginv:hover {
            width: 20px ;
            height: 20px;
            position: absolute;
        }

        .imgesp {
            position: absolute;
            top: 49%; left:7%;
            resize: both;
        }

        .imgesp:hover {
            width: 20px ;
            height: 20px;
            position: absolute; 
        }

        .imgpet {
            position: absolute;
            top: 26%; left:73%;
        }

        .imgpet:hover {
            position: absolute;
        }
</style>
</head>
<body>
    <div class="panel-box-admin">
        <h2>Bienvenido Administrador!</h2>
        
    </div>
        <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>

    <div class="panel-box">
        
        <!-- Formulario para crear un nuevo usuario -->
        <h3>Crear Nuevo Usuario</h3>
        <form action="crear_usuario.php" method="POST">
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="form-group">
                <label for="nombre">nombre completo:  &nbsp;&nbsp; </label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="rol">
                <label for="rol"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol:</label>
                <select id="rol" name="rol">
                
                    <!--<option disabled selected default>Rol</option>--->
                    <option value="Funcionario">Funcionario</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Supervisor">Supervisor</option>
                </select>
            </div>
            <input class="crear_usu" type="submit" value="Crear Usuario" >

            <div>
            <br>
                <a class ="lista" href='listar_usuarios.php' class="lista">Lista de Usuarios</a>
            </div>
        </form>
    </div> 
    <form action="inventario.php" method="POST">
        <input class="custom-button" name="inv" type="submit" value="INVENTARIO">
    </form>   
    <form action="espacios.php" method="POST">
        <input class="custom-button2" name="inv" type="submit" value="ESPACIOS">
    </form>  
    <form action="verificarPeticionesInsumos.php" method="POST">
        <input class="custom-button3" name="inv" type="submit" value="PETICIONES DE INSUMOS">
    </form>
    <form action="verificarPeticionesEspacios.php" method="POST">
        <input class="custom-button4" name="inv" type="submit" value="PETICIONES DE ESPACIOS">
    </form>
    <form action="prestamos_insumos.php" method="POST">
        <input class="custom-button5" name="inv" type="submit" value="PRESTAMOS">
    </form>

    <a class="imginv"><img src='imagenes/inventario.PNG' /></a>
    <a class="imgesp" ><img src='imagenes/espacio1.jpg' /></a>
    <a class="imgpet" ><img src='imagenes/peticiones.png' /></a>
</body>
</html>
