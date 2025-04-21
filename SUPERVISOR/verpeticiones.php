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

<STYle>
        html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
        body{
        font-family: Arial, sans-serif;
            margin-top: 3%;
            margin-right: 7%;    }
        .panel-box-admin {
            color: white;
            width: 100%;
            height: 75px;
            position: absolute;
            padding-bottom: 8px;
            top: 0%; left:0%;
            background-color: red;
            border-bottom: #943126 10px solid;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        .tabla1 {
            margin-top: 7%;
            margin-left: 20%;
            top: 50%;
            left: 50%;
        }

        th {
            text-align: center;
        }
        tr {
            text-align: center;
        }
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            margin-left: 120px;       
            border-collapse: collapse; 
        }

        th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: red;
            border-top: 4px solid #FC472F;    border-bottom: 1px solid #fff; color: white; font-weight: bold; }

        td {    padding: 8px;     background: white;     border-bottom: 1px solid #fff;
            color: black;    border-top: 1px solid transparent; border-color: black; }
        .custom-button2 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
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
</STYle>
<?php
             
        // Consulta SQL con LIMIT para obtener registros de la página actual
        $rol_b = "Estudiante";
        $sql = "SELECT i.pide, i.equipo, i.estado_peticion, i.dia_entrega, i.dia_devolucion, i.horario_prestamo FROM peticiones_estudiantes as i LEFT JOIN usuarios as e ON i.pide = e.nombre WHERE i.pide = '$nombre' AND e.rol = '$rol_b'";
        $resultado = $conexion->query($sql);
        
        
        // Calcular el número total de páginas
        //$numTotalPaginas = ceil($totalRegistros / $registrosPorPagina); 

        if ($resultado->num_rows > 0) {
            echo "<div class='panel-box-admin'>";
            echo"<h2 align='center'>PETICIONES</h2>";
            echo "</div>";
        echo "<table class= 'tabla1' border='1'>";
        echo "<th style=width:200px;>Estudiante</th>
        <th style=width:150px;>Nombre del equipo</th>
        <th>Estado</th>
        <th style=width:150px;>Fecha de prestamo</th>
        <th style=width:150px;>Fecha de devolucion</th>
        </tr>";
        
        while($row = $resultado->fetch_assoc()) {
            
                echo "<tr>";
                echo "<td>" .$row["pide"]. "</td>";
                echo "<td>" .$row["equipo"]. "</td>";
                echo "<td>" .$row["estado_peticion"]. "</td>";
                echo "<td>" .$row["dia_entrega"]. "</td>";
                echo "<td>" .$row["dia_devolucion"]. "</td>";
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