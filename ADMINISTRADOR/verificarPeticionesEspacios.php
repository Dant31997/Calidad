<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Peticiones de espacios</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src='main.js'></script>
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
            left: 5%;
            padding: 10px;
            width: 1200px;
            height: 400px;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
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
            top: 90%;
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
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 2%;
            left: 85%;
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
            top: 2%;
            left: 5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button3:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button4 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 2%;
            left: 18%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button4:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        .encabezado {
            background-color: red;
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
        <h2>PETICIONES DE ESPACIOS</h2>
    </div>

    <div class="dropdown-nav">
        <button class="dropbtn">&#9776;</button>
        <div class="dropdown-content">
            <a href="inventario.php"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
            <a href="prestamos_insumos.php"><i class="fa-solid fa-handshake"></i> Préstamos</a>
            <a target="_blank" href="exportar_PeticionesEspacios.php"><i class="fa-solid fa-file-export"></i> Informe de Peticiones de Espacios</a>
            <a href="espacios.php"><i class="fa-solid fa-house"></i> Volver a espacios</a>
            <a href="../cerrar_sesion.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
        </div>
    </div>

    <?php
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $registrosPorPagina = 4;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;

    $sql = "SELECT * FROM peticiones_espacios WHERE estado_peticion = 'Sin Revisar' LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);

    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM peticiones_espacios WHERE estado_peticion = 'Sin Revisar'")->fetch_assoc()['total'];

    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);


    if ($resultado->num_rows > 0) {

        echo "<div class='tabla1'>";
        echo "<table >";
        echo "<tr class='encabezado' >
        <th style=width:50px;>ID</th>
        <th style=width:250px;>Nombre de la persona</th>
        <th style=width:100px;>Espacio</th>
        <th style=width:200px;>Estado del insumo</th>
        <th style=width:200px;  >Dia que se necesita</th>
        <th style=width:200px;>Hora de entrega</th>
        <th style=width:200px;>Hora de regreso</th>
       
        <th style=width:100px;>Acciones</th> </tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['pide'] . "</td>";
            echo "<td>" . $fila['nom_espacio'] . "</td>";
            echo "<td>" . $fila['estado_peticion'] . "</td>";
            echo "<td>" . $fila['fecha_entrega'] . "</td>";
            echo "<td>" . date('g:i A', strtotime($fila['hora_entrega'])) . "</td>";
            echo "<td>" . date('g:i A', strtotime($fila['hora_regreso'])) . "</td>";
            echo "<td>  
                    <a title='Asignar' class='asignar-btn' style='margin-right: 1px;' href='asignar_espacio.php?id=" . $fila['id']
                . "&nom_espacio=" . $fila['nom_espacio'] . "&pide=" . $fila['pide'] . "&hora_entrega=" . $fila['hora_entrega'] .
                "&hora_regreso=" . $fila['hora_regreso'] . "&fecha_entrega=" . $fila['fecha_entrega'] . "'><img src='imagenes/asignar.png' alt='Asignar' /></a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No hay usuarios en la base de datos.";
    }
    ?>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='verificarPeticionesEspacios.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>
</body>

</html>