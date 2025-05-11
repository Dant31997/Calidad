<?php
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$idPeticion = $_POST['idPeticion'] ?? '';

//Consulta el estado de la petición
$stmt2 = $conexion->prepare("SELECT estado_peticion, id_prestamo FROM peticiones_insumos WHERE id = ?");
$stmt2->bind_param("s", $idPeticion);
$stmt2->execute();
$result2 = $stmt2->get_result();

$estado = "";
if ($result2 && $row = $result2->fetch_assoc()) {
    $estado = $row['estado_peticion'];
} else {
    echo "No se encontró la petición con ID: " . htmlspecialchars($idPeticion);
}
$idPrestamo = $row['id_prestamo'] ?? '';
// Verifica si se obtuvo el ID de préstamo

// Consulta para obtener items del inventario relacionados con el préstamo
// Usar consulta preparada para prevenir SQL injection
$stmt3 = $conexion->prepare("SELECT * FROM inventario WHERE id_prestamo = ?");
$stmt3->bind_param("s", $idPrestamo);
$stmt3->execute();
$resultado = $stmt3->get_result();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Insumos</title>
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --border-color: #ddd;
            --success-color: #34a853;
            --error-color: #ea4335;
        }

        .regresar {
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 90%;
            left: 40%;
        }

        .regresar:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        #resultadoConsulta {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h3,
        h4 {
            color: var(--primary-color);
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        @media (max-width: 600px) {
            form {
                grid-template-columns: 1fr;
            }
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            grid-column: span 2;
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        @media (max-width: 600px) {
            button {
                grid-column: span 1;
            }
        }

        button:hover {
            background-color: #3367d6;
        }

        #tablaInsumos {
            margin-top: 30px;
        }

        #tabla-inventario {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        #tabla-inventario th,
        #tabla-inventario td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        #tabla-inventario th {
            background-color: var(--secondary-color);
            font-weight: 600;
            color: var(--primary-color);
        }

        #tabla-inventario tr:hover {
            background-color: rgba(66, 133, 244, 0.05);
        }

        #tabla-inventario tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
</head>

<body>

    <div id="resultadoConsulta">
        <h3>Resultado de la consulta</h3>
        <form id="consultaFormulario" onsubmit="return consultarEstado(event)">
            <div>
                <label for="idPeticion">ID de Petición:</label>
                <input type="text" id="idPeticion" name="idPeticion" value="<?php echo htmlspecialchars($idPeticion); ?>" required>
            </div>

            <div>
                <label for="estadoPeticion">Estado de Petición:</label>
                <input type="text" id="estadoPeticion" name="estadoPeticion" value="<?php
                                                                                    echo htmlspecialchars($estado); ?>" readonly>
            </div>
        </form>

        <div id="tablaInsumos">
            <h4>Detalle de Insumos</h4>
            <table id="tabla-inventario">
                <thead>
                    <tr class='encabezado'>
                        <th>Cod. Inventario</th>
                        <th>Equipo</th>
                        <th>Descripción</th>
                        <th>Encargado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado && $resultado->num_rows > 0) {
                        // Mostrar registros
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila['cod_inventario']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['nom_inventario']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['Descripcion']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['prestado_a']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No se encontraron items de inventario para este préstamo</td></tr>";
                    }
                    $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function consultarEstado(event) {
            event.preventDefault();
            // Aquí puedes agregar el código JavaScript para manejar la consulta
            // Por ejemplo, usando fetch o XMLHttpRequest para actualizar la información sin recargar la página

            // Por ahora, simplemente enviamos el formulario:
            document.getElementById('consultaFormulario').submit();
        }
    </script>
    <a class="regresar" href="consulta_peticion.php">Volver atras</a>
</body>

</html>