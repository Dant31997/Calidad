<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta para obtener los nombres de los tipos de insumos
$sql = "SELECT nombre_insumo FROM tipo_insumo";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Administrador</title>
    <style>
        html {
            background: linear-gradient(to bottom, white, 30%, #FADBD8);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            font-family: Arial, sans-serif;
            margin-bottom: 15%;

        }

        .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 85%;
            left: 43.5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .regresar:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 35%;
        }

        .custom-button:hover {
            background-color: #D62828;
        }

        .custom-button2 {
            position: absolute;
            top: 3%;
            left: 55%;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .custom-button2:hover {
            background-color: #D62828;
        }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }

        .login-box {
            width: 360px;
            height: 320px;
            position: absolute;
            top: 20%;
            left: 35%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .btno {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 30%;
            margin-top: 1px ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btno:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="textarea"],
        input[type="text"],
        select {
            width: 100%;
            padding: 8px 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="textarea"]:focus,
        select:focus {
            outline: none;
            border-color: #b9c9fe;
            box-shadow: 0 0 5px rgba(185, 201, 254, 0.5);
        }

        select {
            background-color: white;
            cursor: pointer;
        }

        select:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Agregar Objeto al Inventario</h2>
        <br>
        <form action="proces_objeto.php" method="post">
            <label for="nombre">Tipo de insumo:</label>
            <select name="nombre" required>
                <option disabled selected value="">Seleccione un insumo</option>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<option value='" . $row['nombre_insumo'] . "'>" . $row['nombre_insumo'] . "</option>";
                    }
                }
                ?>
            </select>
            <br>
            <label for="descripcion">Descripción:</label>
            <input style="height: 100px;" type="textarea" name="descripcion" required>
            <br>
            <input class="btno" type="submit" name="agregar" value="Agregar Objeto">
            <br>
        </form>
    </div>
    <a class="custom-button2" href="tipo_insumo.php" style="margin-top: 10px; margin-left: 25%;">Tipos de Insumo</a>
    <a class="regresar" href="inventario.php">Volver al inventario</a>
</body>

</html>