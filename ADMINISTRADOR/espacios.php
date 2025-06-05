<title>ESPACIOS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    .regresar {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 90.5%;
        left: 52%;
    }

    .regresar:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        top: 90.5%;
        left: 41.5%;
    }

    .custom-button:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .peticiones-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #D62828;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 2%;
        left: 10%;
    }

    .peticiones-button:hover {
        background-color: #ff0000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th {
        text-align: center;
    }

    tr {
        text-align: center;
    }

    .tabla1 {
        margin-top: 5%;
        position: absolute;
        top: 2%;
        left: 2%;
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
        color: white;
        background: red;
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

    .title2 {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        color: white;
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

    .panel-box-admin {
        width: 100%;
        height: 60px;
        position: absolute;
        padding-bottom: 8px;
        top: 0%;
        left: 0%;
        background-color: red;
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
        top: 2%;
        left: 75%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button3:hover {
        background-color: #ff0000;
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
<?php
echo "<div class='tabla2'>";
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$registrosPorPagina = 4;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Consulta SQL con LIMIT para obtener registros de la página actual
$offset = ($paginaActual - 1) * $registrosPorPagina;
$sql = "SELECT * FROM espacios LIMIT $offset, $registrosPorPagina";
$resultado = $conexion->query($sql);

// Consulta SQL para obtener el número total de registros
$totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM espacios")->fetch_assoc()['total'];

// Calcular el número total de páginas
$numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

if ($resultado->num_rows > 0) {
    echo "<div class='panel-box-admin'>";
    echo "<h2 class ='title2' align='center'>ESPACIOS</h2>";
    echo "</div>";

    echo "<table class='tabla1'>";
    echo "<tr class= 'encabezado'>
    <th>Cód.espacio</th>
    <th style=width:200px; > Nombre del espacio </th>
    <th style=width:500px;> Descripción </th>
    <th style=width:200px;> Capacidad </th>
    <th style=width:80px;> Estado </th>
    <th style=width:100px>Acciones</th>
    </tr>";


    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['cod_espacio'] . "</td>";
        echo "<td>" . $fila['nom_espacio'] . "</td>";
        echo "<td>" . $fila['Descripcion'] . "</td>";
        echo "<td>" . $fila['capacidad'] . "</td>";
        echo "<td>" . $fila['estado_espacio'] . "</td>";
        echo "<td><a href='editar_espacio.php?cod_espacio=" . $fila['cod_espacio'] . "&capacidad=" . $fila['capacidad'] . "&nom_espacio=" . $fila['nom_espacio'] . "&estado_espacio=" . $fila['estado_espacio'] .  "&Descripcion=" . $fila['Descripcion'] . "'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminar_espacio.php?cod_espacio=" . $fila['cod_espacio'] . "'><img src='imagenes/eliminar.png' /></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

$conexion->close();

?>
<div class="dropdown-nav">
    <button class="dropbtn">&#9776;</button>
    <div class="dropdown-content">
        <a href="inventario.php"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
        <a href="prestamos_insumos.php"><i class="fa-solid fa-handshake"></i> Préstamos</a>
        <a href="listar_usuarios.php"><i class="fa-solid fa-users"></i> Gestion de Usuarios</a>
        <a href="verificarPeticionesEspacios.php"><i class="fa-solid fa-envelope-open-text"></i> Peticiones de Espacios</a>
        <a target="_blank" href="exportar_esp.php"><i class="fa-solid fa-file-export"></i> Informe de Espacios</a>
        <a href="admin_panel.php"><i class="fa-solid fa-house"></i> Volver al inicio</a>
        <a href="../cerrar_sesion.php" ><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
    </div>
</div>

<div class="pagination">
    <?php
    for ($i = 1; $i <= $numTotalPaginas; $i++) {
        $claseActiva = ($i == $paginaActual) ? "active" : "";
        echo "<a class='$claseActiva' href='espacios.php?pagina=$i'>$i</a>";
    }
    ?>
</div>
<br>


<a class="custom-button" href="agregarespacio.php">Agregar Espacio</a>
