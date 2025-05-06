<?php
// filepath: c:\xampp\htdocs\proyectofinal\ADMINISTRADOR\asignar_inventario.php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Configuración de la paginación
$registrosPorPagina = 8; // Número de registros por página
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $registrosPorPagina;

// Consulta para contar el total de registros
$sqlTotal = "SELECT COUNT(*) AS total FROM prestamos_insumos WHERE estado = 'Prestado' AND estado_equipos = 'No asignado'";
$resultadoTotal = $conexion->query($sqlTotal);
$totalRegistros = $resultadoTotal->fetch_assoc()['total'];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Consulta para obtener los registros con límite y desplazamiento
$sql = "SELECT id_prestamo, insumo, cantidad, nombre_persona_prestamo 
        FROM prestamos_insumos 
        WHERE estado = 'Prestado' AND estado_equipos = 'No asignado'
        LIMIT $registrosPorPagina OFFSET $offset";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Inventario</title>
    <div class='panel-box-admin'>
        <h2 class='title1' style="text-align: center;">Asignar Inventario</h2>
    </div>
</head>
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
    }

    .custom-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 1.5%;
        left: 5%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .asignar-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 1.5%;
        left: 20%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .asignar-button:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button2 {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 90%;
        left: 43%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button2:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button3 {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 1.5%;
        left: 85%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button3:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .encabezado {
        background-color: red;
    }

    table {
        position: absolute;
        top: 10%;
        left: 27%;
        text-align: center;
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 18px;
        border-radius: 10px;
        padding: 10px;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    th {
        font-size: 13px;
        font-weight: normal;
        padding: 8px;
        color: #FCFCFC;
        font-weight: bold;
        border-radius: 5px;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    td {
        padding: 8px;
        background: white;
        color: black;
        border-radius: 5px;
        background-color: white;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    tr:hover td {
        background: #f5f5f5;
    }

    .action-button {
        padding: 5px 10px;
        background-color: #ff0000;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .action-button:hover {
        background-color: #d62828;
    }



    .title1 {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        color: white;
        position: absolute;
        top: 1%;
        left: 42%;
        margin-top: 0.5%;
    }

    .pagination {
        text-align: center;
        position: absolute;
        top: 82%;
        left: 48%;
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

    .pagination2 {
        text-align: center;
        position: absolute;
        top: 80%;
        left: 82%;
    }

    .pagination2 a {
        display: inline-flexbox;
        padding: 5px 10px;
        margin-left: 1%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        text-decoration: none;
        color: #000;
    }

    .pagination2 a.active2 {
        background-color: #ff0000;
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .panel-box-admin {
        width: 100%;
        height: 40px;
        position: absolute;
        padding-bottom: 8px;
        top: 0%;
        left: 0%;
        background-color: red;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }

    .encabezado {
        background-color: red;
    }

    .tabla-container {
        width: 400px;
        height: 380px;
        position: absolute;
        top: 15%;
        right: 1%;
        padding: 5px 10px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .tabla-resumen {
        width: 100%;
        border-collapse: collapse;
    }

    .tabla-resumen th {
        background-color: #ff0000;
        color: white;
        padding: 12px;
        text-align: center;
        border-radius: 5px;
    }

    .tabla-resumen td {
        padding: 10px;
        text-align: center;
        background-color: #fff;
        border-radius: 5px;
    }

    .tabla-resumen tr:hover td {
        background-color: #f5f5f5;
    }
</style>

<body>
    <table>
        <thead>
            <tr class='encabezado'>
                <th>ID Préstamo</th>
                <th>Insumo</th>
                <th>Cantidad</th>
                <th>Nombre del Encargado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr >";
                    echo "<td>" . $fila['id_prestamo'] . "</td>";
                    echo "<td>" . $fila['insumo'] . "</td>";
                    echo "<td>" . $fila['cantidad'] . "</td>";
                    echo "<td>" . $fila['nombre_persona_prestamo'] . "</td>";
                    echo "<td>
                            <form action='lista_inventario.php' method='GET'>
                                <input type='hidden' name='id_prestamo' value='" . $fila['id_prestamo'] . "'>
                                <input type='hidden' name='insumo' value='" . $fila['insumo'] . "'>
                                <input type='hidden' name='cantidad' value='" . $fila['cantidad'] . "'>
                                <input type='hidden' name='nombre_persona_prestamo' value='" . $fila['nombre_persona_prestamo'] . "'>
                                <button type='submit' class='action-button'>Asignar</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align: center;'>No hay prestamos por asignar</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $activeClass = ($i == $paginaActual) ? "active" : "";
            echo "<a href='?pagina=$i' class='$activeClass'>$i</a>";
        }
        ?>
    </div>

    <script>
        function asignar(idPrestamo) {
            // Aquí puedes agregar la lógica para manejar la acción de asignar
            // Por ejemplo, redirigir a otra página o realizar una solicitud AJAX
            alert('Asignar el préstamo con ID: ' + idPrestamo);
        }
    </script>

    <a class="custom-button2" href="inventario.php">Volver al inventario</a>
</body>

</html>

<?php
// Cierra la conexión
$conexion->close();
?>