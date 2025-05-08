<title>INVENTARIO</title>

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
        margin-top: 2%;
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
        top: 13%;
        left: 3%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button:hover {
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
        left: 45%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button2:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button3 {
        display: inline-block;
        padding: 10px 20px;
        background-color: #D62828;
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
        background-color: #943126;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .TipoInsumo-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 13%;
        left: 16%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .TipoInsumo-button:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th {
        text-align: center;
    }

    tr {
        text-align: center;
    }

    .tabla1 {
        position: absolute;
        top: 19%;
        left: 1%;
        padding: 10px;
        width: 880px;
        height: 400px;
    }

    table {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;
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

    .title1 {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        color: white;
    }

    .pagination {
        text-align: center;
        position: absolute;
        top: 83%;
        left: 30%;
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
        height: 50px;
        position: absolute;
        padding-bottom: 8px;
        top: 0%;
        left: 0%;
        background-color: red;
        border-bottom: #943126 10px solid;
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
<?php

$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$registrosPorPagina = 5;
$paginaActual = isset($_GET['pagina1']) ? $_GET['pagina1'] : 1;

// Consulta SQL con LIMIT para obtener registros de la página actual
$offset = ($paginaActual - 1) * $registrosPorPagina;
$sql = "SELECT * FROM inventario LIMIT $offset, $registrosPorPagina";
$resultado = $conexion->query($sql);

// Consulta SQL para obtener el número total de registros
$totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM inventario")->fetch_assoc()['total'];

// Calcular el número total de páginas
$numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Segunda tabla para mostrar la cantidad de insumos por tipo
//-----------------------------------------------------------------------
$registrosPorPagina2 = 6;
$paginaActual2 = isset($_GET['pagina2']) ? $_GET['pagina2'] : 1;

$offset2 = ($paginaActual2 - 1) * $registrosPorPagina2;
$sql2 = "SELECT 
    ti.nombre_insumo, 
    COALESCE(COUNT(i.nom_inventario), 0) as cantidad,
    COALESCE(SUM(CASE WHEN i.estado = 'Libre' THEN 1 ELSE 0 END), 0) as libres
FROM tipo_insumo ti 
LEFT JOIN inventario i ON ti.nombre_insumo = i.nom_inventario 
GROUP BY ti.nombre_insumo 
ORDER BY ti.nombre_insumo ASC 
LIMIT $offset2, $registrosPorPagina2";
$resultado2 = $conexion->query($sql2);

// Consulta SQL para obtener el número total de registros
$totalRegistros2 = $conexion->query("SELECT COUNT(*) as total FROM (
    SELECT ti.nombre_insumo 
    FROM tipo_insumo ti 
    GROUP BY ti.nombre_insumo
) as subquery")->fetch_assoc()['total'];


// Calcular el número total de páginas
$numTotalPaginas2 = ceil($totalRegistros2 / $registrosPorPagina2);


if ($resultado->num_rows >= 0) {

    echo "<div class='panel-box-admin'>";
    echo "<h2 class ='title1' align='center'>INVENTARIO</h2>";
    echo "</div>";

    echo "<div class='tabla1'>";
    echo "<table>";
    echo "<tr  class= 'encabezado'>
    <th style=width:50px;>Cód.inv</th>
    <th style=width:100px;> Tipo de Insumo </th>
    <th style=width:250px;> Descripcion</th>
    <th style=width:150px;> Prestado a</th>
    <th style=width:60px;> Estado </th>
    <th style=width:100px;>Acciones</th>
    </tr>";


    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr class= 'encabezado'>";
        echo "<td>" . $fila['cod_inventario'] . "</td>";
        echo "<td>" . $fila['nom_inventario'] . "</td>";
        echo "<td>" . $fila['Descripcion'] . "</td>";
        echo "<td>" . $fila['prestado_a'] . "</td>";
        echo "<td>" . $fila['estado'] . "</td>";
        echo "<td><a href='editarobjeto.php?cod_inventario=" . $fila['cod_inventario'] . "&nom_inventario=" . $fila['nom_inventario'] . "&estado=" . $fila['estado'] . "&Descripcion=" . $fila['Descripcion'] .  "'><img src='imagenes/editar.png' /></a>
                  <a href='eliminar_objeto.php?cod_inventario=" . $fila['cod_inventario'] . "'><img src='imagenes/eliminar.png' /></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}
$conexion->close();

?>
<div class="pagination">
    <?php
    for ($i = 1; $i <= $numTotalPaginas; $i++) {
        $claseActiva = ($i == $paginaActual) ? "active" : "";
        echo "<a class='$claseActiva' href='inventario.php?pagina1=$i";
        // Mantener el estado de la otra paginación
        if (isset($_GET['pagina2'])) {
            echo "&pagina2=" . $_GET['pagina2'];
        }
        echo "'>$i</a>";
    }
    ?>
</div>

<?php


?>
<div class="tabla-container">
    <h2 style="text-align: center;">Cantidad por insumo</h2>
    <table class="tabla-resumen">
        <thead>
            <tr>
                <th>Tipo de Insumo</th>
                <th>Cantidad</th>
                <th>Libres</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado2->num_rows > 0) {
                while ($row = $resultado2->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre_insumo'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td>" . $row['libres'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No hay datos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="pagination2">
    <?php
    for ($i2 = 1; $i2 <= $numTotalPaginas2; $i2++) {
        $claseActiva2 = ($i2 == $paginaActual2) ? "active2" : "";
        echo "<a class='$claseActiva2' href='inventario.php?pagina2=$i2";
        // Mantener el estado de la otra paginación
        if (isset($_GET['pagina1'])) {
            echo "&pagina1=" . $_GET['pagina1'];
        }
        echo "'>$i2</a>";
    }
    ?>
</div>

<br>
<a class="custom-button" href="agregarobjeto.php">Agregar insumo</a>
<a class="TipoInsumo-button" href="tipo_insumo.php">Tipos de Insumo</a>
<a class="custom-button2" href="admin_panel.php">Volver al inicio</a>
<a class="custom-button3" target="_blank" href='exportar_inv.php'>Exportar a PDF</a>