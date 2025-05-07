<?php
$title = "PRÉSTAMOS";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
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

        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 1.5%;
            left: 85%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }

        .tabla1 {
            position: absolute;
            top: 25%;
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

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            color: white;
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

        .encabezado {
            background-color: red;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 3% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.4s;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input,
        form select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #ff0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-left: 40%;
        }

        form button:hover {
            background-color: #D62828;
        }

        button {
            background-color: #ff0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Modal para editar préstamos de insumos -->
    <div id="editModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="modal.style.display='none';">&times;</span>
            <h2>Devolucion del Préstamo</h2>
            <form id="editForm" method="POST" action="actualizar_prestamo.php">
                <input type="hidden" name="id_prestamo" id="id_prestamo">

                <!-- Tabla de inventario relacionado -->
                <h3>Items de Inventario Relacionados</h3>
                <div style="max-height: 200px; overflow-y: auto;">
                    <table style="width: 100%;">
                        <thead>
                            <tr style="background:red; color: white;">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Prestado a</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="inventario-tabla">
                            <!-- La tabla se llenará dinámicamente -->
                        </tbody>
                    </table>
                </div>
                <br>
                <h3>¿Los equipos devueltos son los mismos que estan relacionados con este préstamo?</h3>
                <button type="submit">Si</button>
                <button style="position: relative; right: 250px;" type="button" onclick="document.getElementById('editModal').style.display = 'none';">No</button>
            </form>
        </div>
    </div>

    <!-- Modal para Editar Préstamo de Espacios -->
    <div id="editEspaciosModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('editEspaciosModal').style.display='none';">&times;</span>
            <h2>Editar Préstamo de Espacios</h2>
            <form id="editEspaciosForm" method="POST" action="actualizar_prestamo_espacios.php">
                <input type="hidden" name="id_prestamo_espacio" id="id_prestamo_espacio">
                <label for="espacio">Espacio:</label>
                <input type="text" name="espacio" id="espacio" required>
                <br>
                <label for="nom_persona">Nombre de la Persona:</label>
                <input type="text" name="nom_persona" id="nom_persona" required>
                <br>
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" required>
                    <option value="Reservado">Reservado</option>
                    <option value="Terminado">Terminado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
                <br>
                <label for="dia_prestamo_espacio">Día del Préstamo:</label>
                <input type="date" name="dia_prestamo_espacio" id="dia_prestamo_espacio" required>
                <br>
                <label for="hora_prestamo_espacio">Hora del Préstamo:</label>
                <input type="time" name="hora_prestamo_espacio" id="hora_prestamo_espacio" required>
                <br>
                <label for="fecha_entrega">Fecha de Entrega:</label>
                <input type="date" name="fecha_entrega" id="fecha_entrega" required>
                <br>
                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>

    <!-- Formulario para seleccionar la tabla -->
    <form method="GET" action="prestamos_insumos.php" style="text-align: center;POSITION: absolute;TOP: 12%;LEFT: 45%;">
        <label for="tabla">Selecciona la tabla:</label>
        <select name="tabla" id="tabla" onchange="this.form.submit()">
            <option value="prestamos_insumos" <?php echo (isset($_GET['tabla']) && $_GET['tabla'] === 'prestamos_insumos') ? 'selected' : ''; ?>>Prestamos Insumos</option>
            <option value="prestamos_espacios" <?php echo (isset($_GET['tabla']) && $_GET['tabla'] === 'prestamos_espacios') ? 'selected' : ''; ?>>Prestamos Espacios</option>
        </select>
    </form>

    <script>
        // Obtener elementos del DOM
        const modal = document.getElementById("editModal");
        const closeModal = document.querySelector(".close");
        const editForm = document.getElementById("editForm");

        // Función para abrir el modal con los datos del registro
        function openModal(id_prestamo, insumo, nombre_persona_prestamo, estado, dia_prestamo, hora_prestamo) {
            document.getElementById("id_prestamo").value = id_prestamo;

            // Cargar datos del inventario relacionados con este préstamo
            cargarInventario(id_prestamo);

            modal.style.display = "block";
        }

        // Función para cargar los datos del inventario mediante AJAX
        function cargarInventario(id_prestamo) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_inventory.php?id_prestamo=' + id_prestamo, true);

            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('inventario-tabla').innerHTML = this.responseText;
                } else {
                    document.getElementById('inventario-tabla').innerHTML = '<tr><td colspan="4">Error al cargar datos del inventario</td></tr>';
                }
            };

            xhr.onerror = function() {
                document.getElementById('inventario-tabla').innerHTML = '<tr><td colspan="4">Error de conexión</td></tr>';
            };

            xhr.send();
        }

        // Función para abrir el modal de edición de préstamos de espacios
        function openEspaciosModal(id_prestamo_espacio, espacio, nom_persona, estado, dia_prestamo, hora_prestamo, fecha_entrega) {
            document.getElementById("id_prestamo_espacio").value = id_prestamo_espacio;
            document.getElementById("espacio").value = espacio;
            document.getElementById("nom_persona").value = nom_persona;
            document.getElementById("estado").value = estado;
            document.getElementById("dia_prestamo_espacio").value = dia_prestamo;
            document.getElementById("hora_prestamo_espacio").value = hora_prestamo;
            document.getElementById("fecha_entrega").value = fecha_entrega;
            document.getElementById("editEspaciosModal").style.display = "block";
        }

        // Cerrar el modal
        closeModal.onclick = function() {
            modal.style.display = "none";
        };

        // Cerrar el modal si se hace clic fuera de él
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
    <?php
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Determinar la tabla seleccionada
    $tablaSeleccionada = isset($_GET['tabla']) ? $_GET['tabla'] : 'prestamos_insumos';

    // Configuración de paginación
    $registrosPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $registrosPorPagina;

    // Consulta SQL con filtro según el estado
    if ($tablaSeleccionada === 'prestamos_insumos') {
        $sql = "SELECT * FROM prestamos_insumos WHERE estado = 'Prestado' AND estado_equipos = 'Asignado' LIMIT $offset, $registrosPorPagina";
    } elseif ($tablaSeleccionada === 'prestamos_espacios') {
        $sql = "SELECT * FROM prestamos_espacios WHERE estado = 'Reservado' LIMIT $offset, $registrosPorPagina";
    }

    $resultado = $conexion->query($sql);

    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM $tablaSeleccionada")->fetch_assoc()['total'];
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

    if ($resultado->num_rows >= 0) {
        echo "<div class='panel-box-admin'>";
        echo "<h2 class='title1' align='center'>$title</h2>";
        echo "</div>";

        echo "<div class='tabla1'>";
        echo "<table>";
        echo "<tr class='encabezado'>";

        // Encabezados dinámicos según la tabla seleccionada
        if ($tablaSeleccionada === 'prestamos_insumos') {
            echo "
                <th style='width:150px;'>Insumo</th>
                <th style='width:200px;'>Nombre de la Persona</th>
                <th style='width:100px;'>Estado</th>
                <th style='width:150px;'>Día del Préstamo</th>
                <th style='width:150px;'>Hora del Préstamo</th>
                <th style='width:100px;'>Hora de Entrega</th>
                <th style='width:100px;'>Hora de Regreso</th>
                <th style='width:100px;'>Acciones</th>
            ";
        } else if ($tablaSeleccionada === 'prestamos_espacios') {
            echo "
                <th style='width:150px;'>Espacio</th>
                <th style='width:200px;'>Nombre de la Persona</th>
                <th style='width:100px;'>Estado</th>
                <th style='width:150px;'>Fecha del Prestamo</th>
                <th style='width:150px;'>Hora del prestamo</th>
                <th style='width:150px;'>Fecha </th>
                <th style='width:100px;'>Hora de Entrega</th>
                <th style='width:100px;'>Hora de Regreso</th>
                <th style='width:100px;'>Acciones</th>
            ";
        }
        echo "</tr>";
        // Mostrar los registros en la tabla seleccionada

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            if ($tablaSeleccionada === 'prestamos_insumos') {
                echo "
                    <td>" . $fila['insumo'] . "</td>
                    <td>" . $fila['nombre_persona_prestamo'] . "</td>
                    <td>" . $fila['estado'] . "</td>
                    <td>" . $fila['dia_prestamo'] . "</td>
                    <td>" . $fila['hora_prestamo'] . "</td>
                    <td>" . $fila['desde'] . "</td>
                    <td>" . $fila['hasta'] . "</td>
                    <td>
                    <button onclick=\"openModal(
                        '{$fila['id_prestamo']}',
                        '{$fila['insumo']}',
                        '{$fila['nombre_persona_prestamo']}',
                        '{$fila['estado']}',
                        '{$fila['dia_prestamo']}',
                        '{$fila['hora_prestamo']}'
                    )\">Devolver</button>
                </td>
                ";
            } elseif ($tablaSeleccionada === 'prestamos_espacios') {
                echo "
                    <td>" . $fila['espacio'] . "</td>
                    <td>" . $fila['nom_persona'] . "</td>
                    <td>" . $fila['estado'] . "</td>
                    <td>" . $fila['dia_prestamo'] . "</td>
                    <td>" . $fila['hora_prestamo'] . "</td>
                    <td>" . $fila['fecha_entrega'] . "</td>
                    <td>" . $fila['desde'] . "</td>
                    <td>" . $fila['hasta'] . "</td>
                    <td>
                    <button onclick=\"openEspaciosModal(
                        '{$fila['id_prestamo_espacio']}',
                        '{$fila['espacio']}',
                        '{$fila['nom_persona']}',
                        '{$fila['estado']}',
                        '{$fila['dia_prestamo']}',
                        '{$fila['hora_prestamo']}',
                        '{$fila['fecha_entrega']}'
                    )\">Devolver</button>
                </td>
                ";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p style='text-align: center;'>No se encontraron registros en la tabla seleccionada.</p>";
    }

    $conexion->close();
    ?>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='prestamos_insumos.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>
    <br>
    <a class="custom-button" href="admin_panel.php">Volver al inicio</a>
</body>

</html>