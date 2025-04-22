<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $nombre = $_GET['nombre'];
}
?>
<html>
    
<head>
    <title>Funcionario</title>
<style>

        body {
            font-family: Arial, sans-serif;
            
        }

        header{
            color: white;
            display: flex;
            align-items: center;
            height: 70px;
            padding: 10px;
            background-color: red;
            border-radius: 10px;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
      
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0074D9;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            
        }
        .btn:hover {
            background-color: #0056b3;
        }

    .logout-button {
            width: 30px;
            height: 50px;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: small;
            color: white;
            text-decoration: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        .logout-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        nav a {
            font-weight: 800;
            padding-right: 10px;
        }

        h2 {
            text-align: center;
        }

        .login-box {
            width: 390px;
            height: 300px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 19%; left: 10%;
            
        }
        .login-box2 {
            width: 390px;
            height: 350px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 19%; left: 60%;
            
        }
        .form-group {
            margin-left: 16px;
        }

        .container {
            max-width: 1000px;
            padding: 1px;
            font-size: medium;
            text-align: center;
            margin-left: 5%;
            color: white;
            margin-right: 45%;
        }

        .buttonM {
            background-color: #ff0000;
            color: #fff;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1px; 
        }
        .buttonM:hover {
            background-color: #D62828;
        }

        .custom-button3 {
            background-color: #ff0000;
            color: #fff;
            font-size:larger;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 9px; 
        }
        .custom-button3:hover {
            background-color: #D62828;
        }

        .custom-button4 {
            background-color: #ff0000;
            color: #fff;
            font-size:larger;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 9px; 
        }
        .custom-button4:hover {
            background-color: #D62828;
        }

        .custom-button5 {
            background-color: #ff0000;
            color: #fff;
            font-size:larger;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 9px; 
        }
        .custom-button5:hover {
            background-color: #D62828;
        }

        .custom-button6 {
            background-color: #ff0000;
            color: #fff;
            font-size:larger;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 9px; 
        }
        .custom-button6:hover {
            background-color: #D62828;
        }
        .inputtexto {
            position: absolute;
            top: 28%; left: 27%;
        }
        .container-izq {
        position: absolute;
        left: 0; /* Alinea al lado izquierdo */
        top: 20%; /* Ajusta la posición vertical */
        width: 40%; /* Ajusta el ancho del contenedor */
        height: 60%; /* Ajusta la altura del contenedor */
        padding: 20px;
        display: flex;
        flex-direction: column; /* Coloca los elementos en una lista vertical */
        align-items: center; /* Alinea los elementos al centro */
        align-content: center; /* Alinea los elementos al centro */
        align-self: center; /* Alinea los elementos al centro */
        text-align: center;
        gap: 15px; /* Espaciado entre los elementos */
        }

        .container-der {
            position: absolute;
            right: 0; /* Alinea al lado derecho */
            top: 22%; /* Ajusta la posición vertical */
            width: 50%; /* Ajusta el ancho del contenedor */
            height: 60%; /* Ajusta la altura del contenedor */
            padding: 20px;
            display: flex;
            flex-direction: column; /* Coloca los elementos en una lista vertical */
            align-items: center; /* Alinea los elementos al centro */
            align-content: center; /* Alinea los elementos al centro */
            align-self: center; /* Alinea los elementos al centro */
            text-align: center;
            gap: 15px; /* Espaciado entre los elementos */
        }
</style>
</head>
<body>
    <header>
        <div class="container">
            <h2>Bienvenido <?php echo $nombre; ?></h2>
        </div>
        <nav>
            <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="container-izq">
        <a class="imginv"><img src='imagenes/inventario.PNG' /></a>
        <a class='custom-button3' href='equipos_profesor.php?nombre=$nombre'>Peticiones de equipos</a>
        <a class='custom-button5' href='equipos_prestados.php?nombre=$nombre'>Equipos prestados</a>
    </div>

    <div class="container-der">
        <a class="imgesp" ><img src='imagenes/espacio1.jpg' /></a>
        <a class='custom-button4' href='espacios_profesor.php?nombre=$nombre'>Peticiones de espacios</a>
        <a class='custom-button6' href='espacios_prestados.php?nombre=$nombre'>Espacios prestados</a>
    </div>
    
    
</body>
</html>
