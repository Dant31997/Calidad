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
            html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
        body {
            margin-bottom: 43%;
            font-family: Arial, sans-serif;
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

        h2{
            text-align: center;
            color: white;
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

        .pagination {
        text-align: center;
        margin-top: 5px;
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


    .custom-button2 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 2%; left: 85%;
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
            top: 2%; left: 5%;
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
            top: 2%; left: 18%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button4:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
        .encabezado{
        background-color: red;
    }

    .tabla1 {
        margin-top: 40%;
        margin-bottom: 2%;
    }

    
    </style>
</head>
<body>
<div class="panel-box-admin">
    <h2>PETICIONES PROFESORES</h2>
</div>

    <?php
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    $registrosPorPagina = 3;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    
    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;
    $sql = "SELECT * FROM peticiones_profesores LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);
    
    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM peticiones_profesores")->fetch_assoc()['total'];
    
    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);
    

    if ($resultado->num_rows > 0) {

        echo "<div class='tabla1'>";
        echo "<table border='1'>";
        echo "<tr class='encabezado' >
        <th style=width:50px;>ID</th>
        <th style=width:250px;>Nombre de la persona</th>
        <th style=width:100px;>Equipo</th>
        <th style=width:50px;>Sonido</th>
        <th style=width:200px;>Estado de la peticion</th>
        <th>Dia que se necesita</th>
        <th>Horario de uso</th>
        <th>Estado de prestamo</th>
        
        <th>Acciones</th> </tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['pide'] . "</td>";
            echo "<td>" . $fila['equipo'] . "</td>";
            echo "<td>" . $fila['sonido'] . "</td>";
            echo "<td>" . $fila['estado_peticion'] . "</td>";
            echo "<td>" . $fila['dia_entrega'] . "</td>";
            echo "<td>" . $fila['horario_prestamo'] . "</td>";
            echo "<td>" . $fila['estado_prestamo'] . "</td>";
            echo "<td><a href='editarpeticion.php?id=" . $fila['id'] . "&equipo=" . $fila['equipo'] ."&pide=" . $fila['pide'] . "&sonido=" . $fila['sonido'] . "&estado_peticion=" . $fila['estado_peticion'] . "&dia_entrega=" . $fila['dia_entrega'] ."&horario_prestamo=" . $fila['horario_prestamo'] ."&estado_prestamo=" . $fila['estado_prestamo'] ."'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminarpeticion.php?id=" . $fila['id'] . "'><img src='imagenes/eliminar.png' /></a></td>";
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
            echo "<a class='$claseActiva' href='inventario.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>

    <?php
        $registrosPorPagina2 = 3;
        $paginaActual2 = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        
        // Consulta SQL con LIMIT para obtener registros de la página actual
        $offset2 = ($paginaActual2 - 1) * $registrosPorPagina2;
        $sql2 = "SELECT * FROM pet_prof_espacios LIMIT $offset2, $registrosPorPagina2";
        $resultado2 = $conexion->query($sql2);
        
        // Consulta SQL para obtener el número total de registros
        $totalRegistros2 = $conexion->query("SELECT COUNT(*) as total FROM pet_prof_espacios")->fetch_assoc()['total'];
        
        // Calcular el número total de páginas
        $numTotalPaginas2 = ceil($totalRegistros2 / $registrosPorPagina2);
        
    
        if ($resultado2->num_rows > 0) {
    
           
            echo "<table border='1'>";
            echo "<tr class='encabezado' >
            <th style=width:50px;>ID</th>
            <th style=width:250px;>Nombre de la persona</th>
            <th style=width:100px;>Espacio</th>
            <th style=width:50px;>Adicional</th>
            <th style=width:200px;>Estado de la peticion</th>
            <th>Dia que se necesita</th>
            <th>Horario de uso</th>
            <th>Estado de prestamo</th>
            <th>Acciones</th> </tr>";

            while ($fila2 = $resultado2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila2['id'] . "</td>";
                echo "<td>" . $fila2['pide'] . "</td>";
                echo "<td>" . $fila2['espacio'] . "</td>";
                echo "<td>" . $fila2['adicional'] . "</td>";
                echo "<td>" . $fila2['estado_peticion'] . "</td>";
                echo "<td>" . $fila2['dia_entrega'] . "</td>";
                echo "<td>" . $fila2['horario_prestamo'] . "</td>";
                echo "<td>" . $fila2['devolvio'] . "</td>";
                echo "<td><a href='editarpeticion.php?id=" . $fila2['id'] . "&espacio=" . $fila2['espacio'] ."&pide=" . $fila2['pide'] . "&adicional=" . $fila2['adicional'] . "&estado_peticion=" . $fila2['estado_peticion'] . "&dia_entrega=" . $fila2['dia_entrega'] ."&horario_prestamo=" . $fila2['horario_prestamo'] ."&devolvio=" . $fila2['devolvio'] ."'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminarpeticion.php?id=" . $fila2['id'] . "'><img src='imagenes/eliminar.png' /></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay usuarios en la base de datos.";
        }
        ?>
        <div class="pagination">
            <?php
            for ($i2 = 1; $i2 <= $numTotalPaginas2; $i2++) {
                $claseActiva2 = ($i2 == $paginaActual2) ? "active" : "";
                echo "<a class='$claseActiva2' href='inventario.php?pagina=$i2'>$i2</a>";
            }
            ?>
        </div>     
    
    <a class ="custom-button2" href="supervisor.php">Volver al inicio</a>
    <a class ="custom-button3" href="1tabla.php">Asignar Espacio</a>
    <a class ="custom-button4" href="1tabla_inv.php">Asignar Equipo</a>
    
</body>
</html>