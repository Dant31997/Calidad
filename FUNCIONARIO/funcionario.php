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
    <title>Panel del Profesor</title>
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
            position: absolute;
            top: 85%; left: 32%;
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
            position: absolute;
            top: 68%; left: 19%;
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
            position: absolute;
            top: 75%; left: 69.5%;
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
            position: absolute;
            top: 80%; left: 19.4%;
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
            position: absolute;
            top: 87%; left: 70%;
        }
        .custom-button6:hover {
            background-color: #D62828;
        }
        .inputtexto {
            position: absolute;
            top: 28%; left: 27%;
        }

    
    </style>
</head>
<body>
    <header>
    <div class="container">
        <h2>Bienvenido profesor/a, <?php echo $nombre; ?>!</h2>
    </div>
    <nav>
        <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </nav>
    </header>
    
    <div class="login-box">
    <h2>Prestamos de equipos</h2>

        <form action="pros_peticion.php" method="POST">

            <div class="form-group">
                <label for="nombre">Nombre del encargado:</label>
                <input type="text" style="width : 180px;" class="inputcentrado" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <br>
              <div class="form-group">
                <label for="equipo">¿Qué equipo necesitas?</label>
                <select id="equipo" name="equipo">
                    <option value="-">-</option>
                    <option value="Portatil">Portatil</option>
                    <option value="Tablet">Tablet</option>
                </select>
                </div>
                <br>
                
                <div class="form-group">
                    <!---
                <label for="sonido">¿Necesita sonido?</label>
                <select id="sonido" name="sonido">
                    <option value="No">No</option>
                    <option value="Si">Si</option> 
                    --->
                </select>
                </div>
                <br>
                <div class="form-group">
                <label for="dia_entrega">Necesito el prestamo para el dia:</label>
                <input type="date" style="width : 100px;"  id="dia_entrega" name="dia_entrega" value="" required>
            </div>
            <br>
            <div class="form-group">
                <label for="horario_prestamo">Horario de prestamo:</label>
                <input type="time" style="width : 130px;" id="horario_prestamo" name="horario_prestamo" value="" required>
            </div>
            <br>
            <div class="form-group">
                <input class="buttonM" type="submit" name= "agregarpeticion" value="Enviar peticion">
            </div>
        </form>
</div>

<div class="login-box2">
    <h2>Prestamos de Espacios</h2>

        <form action="pros_peticion_espacio.php" method="POST">

            <div class="form-group">
                <label for="nombre">Nombre del encargado:</label>
                <input type="text" style="width : 180px;" class="inputcentrado" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <br>
              <div class="form-group">
                <label for="espacio">¿Qué espacio necesitas?</label>
                <select id="espacio" name="espacio">
                <option value="-">-</option>
                    <option value="Salon">Salon</option>
                    <option value="SalaSistemas">Sala de sistemas</option>
                    <option value="evento">Espacio para evento</option>
                    <option value="polideportivo">Polideportivo</option>
                </select>
                </div>
                <br>
                <div class="form-group">
                    ¿Necesitas algun equipo?:
                    <br>
                    <br>
                    <input type="text" style="width : 350px; height: 30px;" id="adicional" name="adicional"value="">
                    </div>
                <br>
                <div class="form-group">
                <label for="dia_entrega">Necesito el prestamo para el dia:</label>
                <input type="date" style="width : 100px;"  id="dia_entrega" name="dia_entrega" value="" required>
            </div>
            <br>
            <div class="form-group">
                <label for="horario_prestamo">Horario de prestamo:</label>
                <input type="text" style="width : 130px;" id="horario_prestamo" name="horario_prestamo" value="" required>
            </div>
            <br>
            <div class="form-group">
                <input class="buttonM" type="submit" name= "agregarpeticion" value="Enviar peticion">
            </div>
        </form>
</div>
<?php
    echo "<a class='custom-button3' href='equipos_profesor.php?nombre=$nombre'>Peticiones <br> de equipos</a>";
?>

<?php
    echo "<a class='custom-button4' href='espacios_profesor.php?nombre=$nombre'>Peticiones <br> de espacios</a>";
?>

<?php
    echo "<a class='custom-button5' href='equipos_prestados.php?nombre=$nombre'>Equipos <br> prestados</a>";
?>

<?php
    echo "<a class='custom-button6' href='espacios_prestados.php?nombre=$nombre'>Espacios <br> prestados</a>";
?>
    
</body>
</html>
