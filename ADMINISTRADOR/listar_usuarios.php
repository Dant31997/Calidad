<!DOCTYPE html>
<html>

<head>

    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        html {
            background: linear-gradient(white, 60%, #FADBD8);
            height: 100%;
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

        .panel-box {
            height: 440px;
            position: absolute;
            top: 12%;
            right: 2%;
            padding: 20px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .crear_usu {
            background-color: #ff0000;
            color: #fff;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            border-color: transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
        }

        .crear_usu:hover {
            background-color: #D62828;
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
            margin-left: 1%;
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

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 16px;
            margin-left: 3%;
            margin-top: 6%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        th {
            font-size: 13px;
            font-weight: normal;
            padding: 8px;
            background: red;
            font-weight: bold;
            border-radius: 5px;
            color: white;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        td {
            padding: 8px;
            background: white;
            color: black;
            border-radius: 5px;
            border-color: white;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        tr:hover td {
            background: #d0dafd;
            color: black;
        }

        caption {
            padding: 0.3em;
            color: #fff;
            background: #000;
        }


        .btno {
            margin-left: 40%;
        }

        h3 {
            text-align: center;
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
            top: 90%;
            left: 80%;
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
            top: 2%;
            left: 85%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button:hover {
            margin-right: 0;
            /* Elimina el margen derecho del último botón */
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
            top: 90%;
            left: 45%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button2:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .pagination {
            text-align: center;
            position: absolute;
            top: 80%;
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

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #ff0000;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.2);
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .rol select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
            font-size: 14px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        .rol select:focus {
            border-color: #ff0000;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.2);
        }

        .rol label {
            font-size: 14px;
            color: #333;
            display: block;
            text-align: left;
            margin-bottom: 5px;
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
    <div class='panel-box-admin'>
        <h2 class='title1'>Gestion de Usuarios</h2>
        <div class="dropdown-nav">
                <button class="dropbtn">&#9776;</button>
                <div class="dropdown-content">
                    <a href="espacios.php"><i class="fa-solid fa-building"></i> Espacios</a>
                    <a href="prestamos_insumos.php"><i class="fa-solid fa-handshake"></i> Préstamos</a>
                    <a href="inventario.php"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
                    <a target="_blank" href="exportar.php"><i class="fa-solid fa-file-export"></i> Informe de Gestion</a>
                    <a href="admin_panel.php"><i class="fa-solid fa-house"></i> Volver al inicio</a>
                    <a href="../cerrar_sesion.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
                </div>
            </div>
    </div>

    <?php
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $registrosPorPagina = 6;
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

        echo "<table >";
        echo "<th style=width:50px;>ID</th>
                <th style=width:250px;>Nombre de la persona</th>
                <th style=width:150px;>Nombre de Usuario</th>
                <th style=width:250px;>Contraseña</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['nombre_usuario'] . "</td>";
            echo "<td>" . $fila['contrasena'] . "</td>";
            echo "<td>" . $fila['rol'] . "</td>";
            echo "<td>" . ($fila['estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
            echo "<td><a href='editar_listado.php?id=" . $fila['id'] . "&estado=" . $fila['estado'] . "&nombre_usuario=" . $fila['nombre_usuario'] . "&nombre=" . $fila['nombre'] . "&rol=" . $fila['rol'] . "'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminar_usuario.php?id=" . $fila['id'] . "'><img src='imagenes/eliminar.png' /></a></td>";
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
<div class=" panel-box">
            <!-- Formulario para crear un nuevo usuario -->
            <h3>Crear Nuevo Usuario</h3>
            <form action="crear_usuario.php" method="POST">
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de Usuario:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre completo: &nbsp;&nbsp; </label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="rol">
                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol" required>
                        <option value="" disabled selected>Elige un rol</option>
                        <?php
                        if ($resultado->num_rows > 0) {
                            while ($row = $resultado->fetch_assoc()) {
                                echo "<option value='" . $row['nombre_rol'] . "'>" . $row['nombre_rol'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <br>
                <input class="crear_usu" type="submit" value="Crear Usuario">
            </form>
            

</body>

</html>