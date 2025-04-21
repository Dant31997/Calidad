<!DOCTYPE html>
<html>
<head>
    
    <title>Lista de Usuarios</title>
    
    <style>
        html{
            background: linear-gradient(white,60%,#FADBD8 );height:789px; 
        }
        h2{
            text-align: center;
        }
        body {
            
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            margin-left: 40%;
        }
        .pdf-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #E07A5F;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5%;
            margin-left: 45%;
        }

        .pdf-button:hover {
            background-color: #D62828;
            margin-left: 45%;
        }
        th {
            text-align: center;
        }
        tr {
            text-align: center;
        }
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 16px;
            margin-left: 10%;   
            margin-top: 2%;    
            border-collapse: collapse; 
        }

        th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: red; font-weight: bold;
            border-top: 4px solid #FC472F;    border-bottom: 1px solid #fff; color: black; }

        td {    padding: 8px;     background: white;     border-bottom: 1px solid #fff;
            color: black;    border-top: 1px solid transparent; border-color: #333; }

        tr:hover td { background: #d0dafd; color: black; }
        caption {
            padding: 0.3em;
            color: #fff;
            background: #000;
        }
        .formulario{
            margin-left: 40%;
        }
        .btno {
            margin-left: 40%;
        }
        h3 {
            margin-left: 40%;
        }
        .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0074D9;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top:90%; left:80%;
        }
        .regresar:hover {
            background-color: #0056b3;
            margin-left: 45%;
        }
        

        .custom-button {
            padding: 10px 20px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top:2%; left:85%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button:hover {
            margin-right: 0; /* Elimina el margen derecho del último botón */
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button2 {
            padding: 10px 20px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top:90%; left:45%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button2:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    .pagination {
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin: 3px;
        border: 1px solid #d0dafd;
        text-decoration: none;
        color: #000;
    }

    .pagination a.active {
        background-color: #ff0000;
        color: #fff;
        border: 1px solid #000;
    }
    </style>
</head>
<body>
    <h2>Lista de Usuarios</h2>
    
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
    $sql = "SELECT * FROM usuarios LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);
    
    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
    
    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);
    

    if ($resultado->num_rows > 0) {
        echo "<table border='1'>";
        echo "<th style=width:50px;>ID</th><th style=width:150px;>Nombre de Usuario</th><th>Rol</th><th style=width:250px;>Nombre de la persona</th><th style=width:250px;>Contraseña</th><th>Acciones</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['nombre_usuario'] . "</td>";
            echo "<td>" . $fila['rol'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['contrasena'] . "</td>";
            echo "<td><a href='editar_listado.php?id=" . $fila['id'] . "&nombre_usuario=" . $fila['nombre_usuario'] ."&nombre=" . $fila['nombre'] . "&rol=" . $fila['rol'] . "'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminar_usuario.php?id=" . $fila['id'] . "'><img src='imagenes/eliminar.png' /></a></td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "No hay usuarios en la base de datos.";
    }

    
    ?>
    <!-- Crear los enlaces de paginación -->
    
<div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='listar_usuarios.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>
    <br>
    <div class="button-container">
    <a class="custom-button" target="_blank" href='exportar.php'">Exportar a PDF</a> 
    <a class ="custom-button2" href='admin_panel.php?nombre=Administrador'">Volver al Panel</a>
</div>
    
</body>
</html>
