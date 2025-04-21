<style>

html{
            background: linear-gradient(white,60%,#FADBD8 );height:655px;
            
        }
        body{
        font-family: Arial, sans-serif;}
    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin: 2px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
    }

    .pagination a.active {
        background-color: #0074D9;
        color: #fff;
        border: 1px solid #0074D9;
    }

    th {
            text-align: center;
        }
        tr {
            text-align: center;
        }
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 13px;
            margin-left: 20%; 
            margin-top: 2%;      
            border-collapse: collapse; 
        }

        th {     font-size: 15px;     padding: 8px;     background: red;
            border-top: 4px solid #FC472F;    border-bottom: 1px solid #fff; color: white; font-weight: bold; }

        td {    padding: 8px;     background: white;     border-bottom: 1px solid black;
            color: black;    border-top: 1px solid transparent; }

        tr:hover td { background: #d0dafd; color: black; }
        .pagination {
        text-align: center;
    }

    .custom-button2 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 85%; left: 45%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button2:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
</style>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $nombre = $_GET['nombre'];
}

?>
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
        $sql = ( "SELECT * FROM usuarios as i INNER JOIN pet_prof_espacios as e ON i.nombre = e.pide WHERE e.pide = '$nombre' LIMIT $offset, $registrosPorPagina");
        $resultado = $conexion->query($sql);
        
        // Consulta SQL para obtener el número total de registros
        $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM usuarios as i INNER JOIN pet_prof_espacios as e ON i.nombre = e.pide WHERE e.pide = '$nombre'")->fetch_assoc()['total'];
        
        // Calcular el número total de páginas
        $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

        echo "<table border='1'>";
        echo "<th style=width:200px;>Profesor</th><th style=width:150px;>Equipo pedido</th><th style=width:100px>Estado de <br> la peticion</th><th style=width:150px;>Se necesita <br> para la fecha</th><th style=width:150px;>Horario en que <br> se usara</th></tr>";
        
        while($row = $resultado->fetch_array()) {
            
            echo "<tr>";
                echo "<td>" .$row["pide"]. "</td>";
                echo "<td>".$row["espacio"]."</td>";
                echo "<td>" .$row["estado_peticion"]. "</td>";
                echo "<td>" .$row["dia_entrega"]. "</td>";
                echo "<td>" .$row["horario_prestamo"]. "</td>";
                echo "</tr>";
                
        }
        echo "</table>";
            
    ?>
     <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='http://localhost/prueba/profesor.php?pagina=$i'>$i</a>";
        }
        ?>

<a class="custom-button2" href="javascript:history.back()"> Volver Atrás</a>