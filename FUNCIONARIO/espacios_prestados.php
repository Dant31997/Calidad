<style>

html{
            background: linear-gradient(white,60%,#FADBD8 );height:690px;
            
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
            margin-left: 5%; 
            margin-top: 5%;      
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
             
        // Consulta SQL con LIMIT para obtener registros de la página actual
        $rol_b = "Profesor";
        $sql = "SELECT i.persona_encargada, i.nom_espacio, i.estado_espacio, i.fecha_entrega, i.hora_entrega, i.fecha_regreso, i.hora_regreso FROM espacios as i LEFT JOIN usuarios as e ON i.persona_encargada = e.nombre WHERE i.persona_encargada = '$nombre' AND e.rol = '$rol_b'";
        $resultado = $conexion->query($sql);
        
        
        // Calcular el número total de páginas
        //$numTotalPaginas = ceil($totalRegistros / $registrosPorPagina); 

        if ($resultado->num_rows > 0) {
            echo "<div class='panel-box-admin'>";
            echo"<h2 align='center'>Espacios prestados</h2>";
            echo "</div>";
        echo "<table class= 'tabla1' border='1'>";
        echo "<th style=width:200px;>Profesor</th>
        <th style=width:150px;>Nombre del espacio</th>
        <th>Estado</th>
        <th style=width:150px;>Fecha de prestamo</th>
        <th style=width:150px;>Hora de prestamo</th>
        <th style=width:150px;>Fin del prestamo</th>
        <th style=width:150px;>Hora fin del prestamo</th>
        </tr>";
        
        while($row = $resultado->fetch_assoc()) {
            
                echo "<tr>";
                echo "<td>" .$row["persona_encargada"]. "</td>";
                echo "<td>" .$row["nom_espacio"]. "</td>";
                echo "<td>" .$row["estado_espacio"]. "</td>";
                echo "<td>" .$row["fecha_entrega"]. "</td>";
                echo "<td>" .$row["hora_entrega"]. "</td>";
                echo "<td>" .$row["fecha_regreso"]. "</td>";
                echo "<td>" .$row["hora_regreso"]. "</td>";
                echo "</tr>";
         }     
        echo "</table>";
        } else {
            echo "<table border='1'>";
            echo "<th style=width:200px;>Estudiante</th><th style=width:150px;>Nombre del equipo</th><th>Estado</th><th style=width:150px;>Fecha de prestamo</th><th style=width:150px;>Fecha de devolucion</th></tr>";
            echo "<br>";
            echo " <td>No tiene prestamos activos en el momento</td>";
            echo " <td>-</td>";
            echo " <td>-</td>";
            echo " <td>-</td>";
            echo " <td>-</td>";
            echo "</table>";
    }
    
    ?>
    <a class="custom-button2" href="javascript:history.back()"> Volver Atrás</a>