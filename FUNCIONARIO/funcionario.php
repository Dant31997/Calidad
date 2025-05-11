<!DOCTYPE html>
<?php
session_start();
include_once('../session_helper.php');
verificarSesion("Funcionario");
$nombre = $_SESSION['nombre'];
?>
<html>
    
<head>
    <title>Funcionario</title>
<style>
     html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
     }
        body {
            font-family: Arial, sans-serif;
            
        }

        header{
            color: white;
            display: flex;
            align-items: center;
            width: 100%;
            height: 70px;
            padding: 5px;
            background-color: red;
            position: absolute;
            top: 0%; left:0%;
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
            background-color: #ff0000;
            color: white;
            font-size: large;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            position: absolute;
            top: 10px; left: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logout-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        nav a {
            padding-right: 10px;
        }

        h2 {
            position: absolute;
            top: 8px; left: 35%;    
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
            position: absolute;
            top: 62%; left: 43%;
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
        .imgprestamos {
            size-adjust: auto;
            width: 150px;
            height: 150px;
            position: absolute;
            top: 25%; left: 39%;
        }
</style>
</head>
<body>
    <header>
        <div class="container">
            <h2>Bienvenido <?php echo htmlspecialchars($nombre); ?></h2>
        </div>
        <nav>
            <a href="../cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="container-izq">
        <a class="imginv"><img src='imagenes/inventario.PNG' /></a>
        <a class='custom-button3' href='verificarPeticionesInsumos.php'>Peticiones de insumos</a>
        
    </div>
    <div>
        <a class="imgprestamos"><img  src='imagenes/prestamos.PNG' /></a>
        <a class='custom-button5' href='prestamos_insumos.php'>Prestamos</a>
    </div>  

    <div class="container-der">
        <a class="imgesp" ><img src='imagenes/espacio1.jpg' /></a>
        <a class='custom-button4' href='verificarPeticionesEspacios.php'>Peticiones de espacios</a>
    </div>
</body>
</html>
