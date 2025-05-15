<!DOCTYPE html>
<html>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Peticiones</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <style>
        .tabla-container {
            width: 450px;
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
        }

        .panel-box-admin {
            width: 100%;
            height: 60px;
            position: absolute;
            padding-bottom: 8px;
            top: 0%;
            left: 0%;
            background-color: red;
            border-bottom: #943126 10px solid;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: white;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }

        .tabla1 {
            position: absolute;
            top: 13%;
            left: 1%;
            padding: 10px;
            width: 1280px;
            height: 400px;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 13px;
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

        .pagination {
            text-align: center;
            position: absolute;
            top: 82%;
            left: 45%;
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

        .custom-button2 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D62828;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 90%;
            right: 45%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .custom-button2:hover {
            background-color: #943126;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .encabezado {
            background-color: red;
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
            top: 2%;
            right: 10%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button3:hover {
            background-color: #943126;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        select {
            width: 100%;
            /* Ajusta el ancho al contenedor */
            padding: 10px;
            /* Espaciado interno */
            margin-bottom: 15px;
            /* Espaciado inferior */
            border: 1px solid #ccc;
            /* Borde gris claro */
            border-radius: 5px;
            /* Bordes redondeados */
            background-color: #f9f9f9;
            /* Fondo claro */
            font-size: 14px;
            /* Tamaño de fuente */
            color: #333;
            /* Color del texto */
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            /* Sombra interna */
            appearance: none;
            /* Oculta el estilo predeterminado del navegador */
            -webkit-appearance: none;
            /* Compatibilidad con WebKit */
            -moz-appearance: none;
            /* Compatibilidad con Firefox */
            cursor: pointer;
            /* Cambia el cursor al pasar */
        }

        /* Icono de flecha personalizado para el select */
        select:focus {
            outline: none;
            /* Elimina el borde azul al enfocar */
            border-color: #007bff;
            /* Cambia el color del borde al enfocar */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Sombra azul al enfocar */
        }

        /* Efecto hover */
        select:hover {
            background-color: #f1f1f1;
            /* Fondo más claro al pasar el mouse */
            border-color: #bbb;
            /* Cambia el color del borde */
        }

        .asignar-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D62828;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 2%;
            left: 5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .asignar-button:hover {
            background-color: #943126;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="panel-box-admin">
        <h2>PETICIONES DE INSUMOS</h2>
    </div>
    </div>
    <?php

    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $registrosPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;

    // Consulta SQL con LIMIT para obtener registros de la página actual y filtrar por estado_peticion
    $sql = "SELECT * FROM peticiones_insumos WHERE estado_peticion = 'Sin Revisar' LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);

    // Consulta SQL para obtener el número total de registros con estado "Sin Revisar"
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM peticiones_insumos WHERE estado_peticion = 'Sin Revisar'")->fetch_assoc()['total'];

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
        COALESCE(SUM(CASE WHEN i.estado = 'Libre' THEN 1 ELSE 0 END), 0) as libres,
        COALESCE(SUM(CASE WHEN i.estado = 'Averiado' THEN 1 ELSE 0 END), 0) as averiados,
        COALESCE(SUM(CASE WHEN i.estado = 'Bodega' THEN 1 ELSE 0 END), 0) as bodega,
        COALESCE(SUM(CASE WHEN i.estado = 'Prestado' THEN 1 ELSE 0 END), 0) as prestados
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





    



    if ($resultado->num_rows > 0) {

        echo "<div class='tabla1'>";
        echo "<table>";
        echo "<tr class='encabezado' ><th style=width:50px;>ID</th>
        <th style=width:100px;>Equipo</th>
        <th style=width:100px;>Cantidad</th>
        <th style=width:280px;>Nombre de la persona</th>
        <th style=width:150px;>Estado de la peticion</th>
        <th style=width:130px>Fecha</th>
        <th style=width:100px;>Hora del Prestamo</th>
        <th style=width:100px;>Hora de Devolucion</th>
        <th style=width:80px;>Acciones</th> </tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['equipo'] . "</td>";
            echo "<td>" . $fila['cantidad'] . "</td>";
            echo "<td>" . $fila['nom_persona'] . "</td>";
            echo "<td>" . $fila['estado_peticion'] . "</td>";
            echo "<td>" . $fila['dia_entrega'] . "</td>";
            echo "<td>" . date('g:i A', strtotime($fila['hora_entrega'])) . "</td>";
            echo "<td>" . date('g:i A', strtotime($fila['hora_regreso'])) . "</td>";
            echo "<td>  
                    <a title='Asignar' class='asignar-btn' style='margin-right: 1px;' href='asignar_Insumo.php?id="
                . $fila['id'] . "&equipo=" . $fila['equipo'] . "&cantidad=" . $fila['cantidad'] . "&nom_persona=" . $fila['nom_persona'] .
                "&hora_entrega=" . $fila['hora_entrega'] . "&hora_regreso=" . $fila['hora_regreso'] .
                "'><img src='imagenes/asignar.png' alt='Asignar' /></a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No hay peticiones de insumos por responder.";
    }
    ?>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='verificarPeticionesInsumos.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>
    <div class="tabla-container">
        <h2 style="text-align: center; color: #000;">Cantidades por insumo</h2>
        <table class="tabla-resumen">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Total</th>
                    <th>Libres</th>
                    <th>Prestados</th>
                    <th>Averiados</th>
                    <th>En bodega</th>
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
                        echo "<td>" . $row['prestados'] . "</td>";
                        echo "<td>" . $row['averiados'] . "</td>";
                        echo "<td>" . $row['bodega'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay datos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <a class="custom-button2" href="inventario.php">Volver al inicio</a>
    <a class="custom-button3" target="_blank" href='exportar_PeticionesInsumos.php'>Exportar a PDF</a>
</body>

</html>