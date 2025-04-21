<title>INVENTARIO</title>

<style>
    html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
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
            top: 90.5%; left: 35%;
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
            top: 90.5%; left: 54%;
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
            top: 3%; left: 75%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button3:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       
        th {
            text-align: center;
        }
        tr {
            text-align: center;

        }
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            margin-left: 20px;       
            border-collapse: collapse; 
        }

        th {     font-size: 13px;     font-weight: normal;     padding: 8px;
            border-top: 4px solid #FC472F;    border-bottom: 1px solid black; color: white; font-weight: bold; ;  }

        td {    padding: 8px;     background: white;     border-bottom: 1px solid #fff;
            color: black;    border-top: 1px solid black; border-color: #333; }

        tr:hover td { background: #d0dafd; color: #339; }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            color: white;

        }

    .pagination {
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin: 2px;
        border: 1px solid #d0dafd;
        text-decoration: none;
        color: #000;
    }

    .pagination a.active {
        background-color: #ff0000;
        color: #fff;
        border: 1px solid #000;
    }
    .panel-box-admin {
            width: 100%;
            height: 50px;
            position: absolute;
            padding-bottom: 8px;
            top: 0%; left:0%;
            background-color: red;
            border-bottom: #943126 10px solid;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        .tabla1 {
            margin-top: 4%;
        }
    .encabezado{
        background-color: red;
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
            top: 2%; left: 75%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button3:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        

</style>
<?php

$conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    $registrosPorPagina = 7;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    
    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;
    $sql = "SELECT * FROM inventario LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);
    
    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM inventario")->fetch_assoc()['total'];
    
    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

if ($resultado->num_rows >= 0) {

    echo "<div class='panel-box-admin'>";
    echo "<h2 class ='title1' align='center'>INVENTARIO</h2>";
    echo "</div>";
    
    echo "<div class='tabla1'>";
    echo "<table border='1'>";
    echo "<tr  class= 'encabezado'>
    <th style=width:50px;>Cód.inv</th>
    <th style=width:150px;> Nombre del equipo </th>
    <th style=width:80px;> Estado </th>
    <th style=width:300px;> Se presto a</th>
    <th style=width:100px;> Fecha de entrega </th>
    <th style=width:100px> Hora de entrega</th>
    <th style=width:100px;> Fecha de regreso </th>
    <th style=width:100px> Hora de regreso</th>
    <th style=width:150px;>Acciones</th>
    </tr>";
    

    while ($fila = $resultado->fetch_assoc()) { 
        echo "<tr class= 'encabezado'>";
        echo "<td>" . $fila['cod_inventario'] . "</td>";
        echo "<td>" . $fila['nom_inventario'] . "</td>";
        echo "<td>" . $fila['estado'] . "</td>";
        echo "<td>" . $fila['nombre_persona'] . "</td>";
        echo "<td>" . $fila['fecha_entrega'] . "</td>";
        echo "<td>" . $fila['hora_entrega'] . "</td>";
        echo "<td>" . $fila['fecha_regreso'] . "</td>";
        echo "<td>" . $fila['hora_regreso'] . "</td>";
        echo "<td><a href='editarobjeto.php?cod_inventario=" . $fila['cod_inventario'] . "&nom_inventario=" . $fila['nom_inventario'] ."&estado=" . $fila['estado'] . "&fecha_entrega=" . $fila['fecha_entrega'] . "&hora_entrega=" . $fila['hora_entrega'] . "&fecha_regreso=" . $fila['fecha_regreso'] . "&hora_regreso=" . $fila['hora_regreso'] .  "'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminar_objeto.php?cod_inventario=" . $fila['cod_inventario'] . "'><img src='imagenes/eliminar.png' /></a></td>";
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
            echo "<a class='$claseActiva' href='inventario.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>
    <br>
    <a class="custom-button" href="agregarobjeto.php">Agregar Objeto</a>
    
    <a class ="custom-button2" href="supervisor.php">Volver al inicio</a>
    <a class="custom-button3" target="_blank" href='exportar_inv.php'>Exportar a PDF</a>
