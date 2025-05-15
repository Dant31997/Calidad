<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Peticiones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
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

        .dropdown-nav {
            position: absolute;
            top: 1%;
            left: 2%;
            z-index: 1000;
        }

        .dropbtn {
            background-color: #ff0000;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #D62828;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            left: 0;
            background-color: #fff;
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background 0.2s;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: #ff0000;
        }

        .dropdown-nav:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <div class="panel-box-admin">
        <h2>PETICIONES DE INSUMOS</h2>
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

    $nombresInsumo = [];
    $sqlInsumos = "SELECT nombre_insumo FROM tipo_insumo WHERE nivel_insumo IN (3)";
    $resultInsumos = $conexion->query($sqlInsumos);
    while ($row = $resultInsumos->fetch_assoc()) {
        $nombresInsumo[] = $row['nombre_insumo'];
    }

    // Si hay nombres, armar la consulta con IN
    if (count($nombresInsumo) > 0) {
        // Escapar los nombres para la consulta SQL
        $nombresInsumoEscapados = array_map(function ($nombre) use ($conexion) {
            return "'" . $conexion->real_escape_string($nombre) . "'";
        }, $nombresInsumo);
        $listaNombres = implode(",", $nombresInsumoEscapados);

        // Consulta principal
        $sql = "SELECT * FROM peticiones_insumos 
            WHERE estado_peticion = 'Sin Revisar' 
            AND equipo IN ($listaNombres)
            LIMIT $offset, $registrosPorPagina";
    } else {
        // Si no hay insumos, la consulta no traerá resultados
        $sql = "SELECT * FROM peticiones_insumos WHERE 1=0";
    }

    $resultado = $conexion->query($sql);

    if (count($nombresInsumo) > 0) {
        $nombresInsumoEscapados = array_map(function ($nombre) use ($conexion) {
            return "'" . $conexion->real_escape_string($nombre) . "'";
        }, $nombresInsumo);
        $listaNombres = implode(",", $nombresInsumoEscapados);

        // Consulta para contar solo los registros que cumplen ambas condiciones
        $sqlTotal = "SELECT COUNT(*) as total FROM peticiones_insumos 
                 WHERE estado_peticion = 'Sin Revisar' 
                 AND equipo IN ($listaNombres)";
        $totalRegistros = $conexion->query($sqlTotal)->fetch_assoc()['total'];
    } else {
        $totalRegistros = 0;
    }

    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);


    if ($resultado->num_rows > 0) {

        echo "<div class='tabla1'>";
        echo "<table>";
        echo "<tr class='encabezado' ><th style=width:50px;>ID</th>
        <th style=width:100px;>Equipo</th>
        <th style=width:100px;>Cantidad</th>
        <th style=width:280px;>Nombre de la persona</th>
        <th style=width:150px;>Estado de la peticion</th>
        <th style=width:130px>Fecha</th>
        <th style=width:100px;>Hora de Salida</th>
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

    <div class="dropdown-nav">
        <button class="dropbtn">&#9776;</button>
        <div class="dropdown-content">
            <a href="verificarPeticionesEspacios.php"><i class="fa-solid fa-envelope-open-text"></i> Peticiones de Espacios</a>
            <a href="prestamos_insumos.php"><i class="fa-solid fa-handshake"></i> Préstamos</a>
            <a href="funcionario.php"><i class="fa-solid fa-house"></i> Volver al inicio</a>
            <a href="../cerrar_sesion.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
        </div>
    </div>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='verificarPeticionesInsumos.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>



</body>

</html>