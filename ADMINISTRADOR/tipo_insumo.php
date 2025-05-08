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

$registrosPorPagina = 5;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Consulta SQL con LIMIT para obtener registros de la página actual
$offset = ($paginaActual - 1) * $registrosPorPagina;
$sql2 = "SELECT id_insumo, nombre_insumo FROM tipo_insumo ORDER BY id_insumo ASC LIMIT $offset, $registrosPorPagina";
$resultado2 = $conexion->query($sql2);

// Consulta SQL para obtener el número total de registros
$totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM tipo_insumo")->fetch_assoc()['total'];

// Calcular el número total de páginas
$numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de insumo</title>
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

        .login-box2 {
            width: 330px;
            text-align: center;
            height: 200px;
            position: absolute;
            top: 20%;
            left: 10%;
            padding: 20px;
            display: inline-block;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            /* Ajusta el valor para cambiar la curvatura de las esquinas */
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
            margin-left: 2%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btno:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .tabla-container {
            width: 650px;
            position: absolute;
            top: 5%;
            left: 45%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 50px;
        }

        .tabla-insumos {
            width: 100%;
            margin-top: 10px;
        }

        .tabla-insumos th,
        .tabla-insumos td {
            padding: 15px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .tabla-insumos th {
            background-color: #ff0000;
            color: white;
        }

        .tabla-insumos tr:hover {
            background-color: #f5f5f5;
        }

        .pagination {
            text-align: center;
            position: absolute;
            top: 75%;
            left: 68%;
        }

        .pagination a {
            display: inline-flexbox;
            padding: 5px 10px;
            margin-left: 1%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-decoration: none;
            color: #000;
        }

        .pagination a.active {
            background-color: #ff0000;
            color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
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
            top: 90%;
            left: 45%;
        }

        .regresar:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="login-box2">
        <h2>Nuevo Tipo de Insumo</h2>
        <form action="p_tipo_insumo.php" method="post">
            <label for="nombre_insumo">Nombre del tipo de insumo:</label>
            <input type="text" name="nombre_insumo" required>
            <br><br>
            <input class="btno" type="submit" name="agregar" value="Agregar">
        </form>
    </div>
    <div class="tabla-container">
        <h2>Lista de Tipos de Insumo</h2>
        <table class="tabla-insumos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Insumo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado2->num_rows > 0) {
                    while ($row = $resultado2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_insumo'] . "</td>";
                        echo "<td>" . $row['nombre_insumo'] . "</td>";
                        echo "<td>
                                    <a href='eliminar_tipo_insumo.php?id_insumo=" . $row['id_insumo'] . "' 
                                    onclick=\"return confirm('¿Estás seguro de que deseas eliminar este tipo de insumo?');\">
                                    <img src='imagenes/eliminar.png' alt='Eliminar' title='Eliminar' style='width:20px; height:20px;'>
                                    </a>
                             </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No hay tipos de insumo registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='tipo_insumo.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>

    <a class="regresar" href="inventario.php">Volver al inicio</a>
</body>

</html>