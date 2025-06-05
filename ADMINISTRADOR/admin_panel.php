<!DOCTYPE html>
<?php
session_start();
include_once('../session_helper.php');
verificarSesion("Administrador");

$nombre = $_SESSION['nombre'];

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta para obtener los roles del usuario
$consulta = "SELECT * FROM roles";
$resultado = $conexion->query($consulta);

?>

<html>

<head>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Panel de Administrador</title>

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
            top: 20px;
            left: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logout-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .panel-box {
            max-width: 800px;
            height: 440px;
            position: absolute;
            top: 15%;
            left: 39%;
            padding: 20px;
            width: 350px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .panel-box-admin {
            width: 550px;
            height: 65px;
            position: absolute;
            top: 2%;
            left: 33%;
            background-color: red;
            border: 1px solid #ccc;
            border-radius: 10px;
            /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .lista {
            padding: 11px 20px;
            background-color: red;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 59%;
            left: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
            font-weight: bold;
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
            border-color: transparent;
            position: absolute;
            top: 88%;
            left: 6%;
            font-size: 16px;
            font-weight: bold;
        }

        .crear_usu:hover {
            background-color: #D62828;
        }

        h2 {
            color: white;
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        .custom-button {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 59%;
            left: 7%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
            font-weight: bold;
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
            top: 59%;
            left: 28%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
            font-weight: bold;
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
            top: 58.5%;
            left: 73%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
            font-weight: bold;
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
            top: 68%;
            left: 73%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
            font-weight: bold;
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
            top: 59%;
            left: 73.5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
            font-weight: bold;
        }

        .custom-button5:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

        .rol {
            left: 50%;
        }


        .imginv {
            position: absolute;
            top: 28%;
            left: 11%;
        }

        .imginv:hover {
            width: 20px;
            height: 20px;
            position: absolute;
        }

        .imgesp {
            position: absolute;
            top: 29%;
            left: 28%;
            resize: both;
        }

        .imgesp:hover {
            width: 20px;
            height: 20px;
            position: absolute;
        }

        .imgpet {
            position: absolute;
            top: 26%;
            left: 73%;
        }

        .imgpet:hover {
            position: absolute;
        }
        .imagest {
            position: absolute;
            top: 30%;
            left: 53%;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #ff0000;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.2);
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .rol select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
            font-size: 14px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        .rol select:focus {
            border-color: #ff0000;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.2);
        }

        .rol label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="panel-box-admin">
        <h2>Bienvenido <?php echo htmlspecialchars($nombre); ?></h2>
    </div>
    <a href="../cerrar_sesion.php" class="logout-button"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>

    <div>
        <br>
        <a class="lista" href='listar_usuarios.php' class="lista">Gestion de Usuarios</a>
    </div>


    </div>
    <form action="inventario.php">
        <input class="custom-button" name="inv" type="submit" value="INVENTARIO">
    </form>
    <form action="espacios.php">
        <input class="custom-button2" name="inv" type="submit" value="ESPACIOS">
    </form>


    <form action="prestamos_insumos.php">
        <input class="custom-button5" name="inv" type="submit" value="PRESTAMOS">
    </form>

    <a class="imginv"><img src='imagenes/inventario.PNG' /></a>
    <a class="imgesp"><img src='imagenes/espacio1.jpg' /></a>
    <a class="imgpet"><img src='imagenes/peticiones.png' /></a>
    <a class="imagest"><img src='imagenes/gestion.png' width="200" height="200" /></a>
</body>

</html>