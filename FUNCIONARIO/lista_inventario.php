<?php
// filepath: c:\xampp\htdocs\proyectofinal\ADMINISTRADOR\lista_inventario.php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del préstamo desde la URL
$idPrestamo2 = isset($_GET['prestamo_id']) ? $_GET['prestamo_id'] : '';
$idPrestamo = isset($_GET['id']) ? $_GET['id'] : '';
$insumo = isset($_GET['inventario']) ? $_GET['inventario'] : '';
$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : '';
$nombrePersona = isset($_GET['nombre_trabajador']) ? $_GET['nombre_trabajador'] : '';


// Consulta para obtener los registros de la tabla inventario
$sqlInventario = "SELECT cod_inventario, nom_inventario, descripcion 
                  FROM inventario 
                  WHERE estado = 'Libre' AND prestado_a = 'Nadie' AND nivel_acceso = '3'" ;
$resultadoInventario = $conexion->query($sqlInventario);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inventario</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, white, 30%, #FADBD8);
            min-height: 100vh;
            /* Asegura que el contenido ocupe toda la altura */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        body {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            color: black;
            text-align: center;
            position: relative;
            margin-top: -20px;
        }

        form {
            background-color: transparent;
            padding: 20px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 800px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Aumentado para mayor separación */
            box-sizing: border-box;
        }

        form label {
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
            /* Espaciado entre label e input */
            text-align: left;
            /* Alineación consistente */
        }

        form input {
            width: 100%;
            /* Asegura que los inputs ocupen todo el ancho disponible */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 12px;
            box-sizing: border-box;
        }

        .filter-input {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            font-size: 14.5px;
            margin-bottom: 10px;
            margin-top: -30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: red;
            color: white;
            font-weight: bold;
        }

        tr:hover td {
            background-color: #f5f5f5;
        }

        .action-button {
            padding: 10px 20px;
            background-color: #ff0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: absolute;
            top: 10%;
            left: 82%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .action-button:hover {
            background-color: #d62828;
        }

        @media (max-width: 768px) {
            form {
                flex-direction: column;
                /* Cambia a diseño vertical en pantallas pequeñas */
                align-items: stretch;
            }

            form label {
                text-align: left;
            }

            .filter-input,
            table {
                width: 100%;
            }

            th,
            td {
                font-size: 14px;
                padding: 8px;
            }

            .action-button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        .form-container {
            background-color: red;
            padding: 5px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 5px;
            width: 100%;
            max-width: 800px;
            margin-top: -15px;
            height: 80px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        #pagination-controls {
            text-align: center;
            /* Centra el contenido dentro del contenedor */
            margin-top: 20px;
            /* Espaciado superior */
            width: 100%;
            /* Asegura que el contenedor ocupe todo el ancho */
        }

        #pagination-controls button {
            display: inline-block;
            /* Asegura que los botones se alineen horizontalmente */
            margin: 0 5px;
            /* Espaciado entre botones */
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            color: #000;
            cursor: pointer;
        }

        #pagination-controls button.active {
            background-color: #d62828;
            /* Color para el botón activo */
            color: #fff;
        }

        .volver-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 18%;
            left: 85%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .volver-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="title1">
        <h2>Asignar Equipos al Préstamo</h2>
    </div>

    <!-- Formulario con los datos del préstamo -->
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="idPrestamo">ID Préstamo:</label>
                <input type="text" id="idPrestamo" value="<?php echo $idPrestamo; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="insumo">Insumo:</label>
                <input type="text" id="insumo" value="<?php echo $insumo; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" id="cantidad" value="<?php echo $cantidad; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="nombrePersona">Nombre del Encargado:</label>
                <input style="width: 190px;" type="text" id="nombrePersona" value="<?php echo $nombrePersona; ?>" readonly>
            </div>
        </form>
    </div>

    <!-- Filtro para la tabla -->
    <input type="text" id="filtro" class="filter-input" onkeyup="filtrarTabla()" placeholder="Filtrar por nombre de equipo...">

    <!-- Tabla dinámica -->
    <form action="procesar_inventario.php" method="POST">
    <input type="hidden" name="nombrePersona" value="<?php echo $nombrePersona; ?>">
    <input type="hidden" name="idPrestamo" value="<?php echo $idPrestamo2; ?>">
        <table id="tabla-inventario">
            <thead>
                <tr class='encabezado'>
                    <th>Cod. Inventario</th>
                    <th>Equipo</th>
                    <th>Descripción</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultadoInventario->num_rows > 0) {
                    while ($fila = $resultadoInventario->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila['cod_inventario'] . "</td>";
                        echo "<td>" . $fila['nom_inventario'] . "</td>";
                        echo "<td>" . $fila['descripcion'] . "</td>";
                        echo "<td><input type='checkbox' name='equipos[]' value='" . $fila['cod_inventario'] . "'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align: center;'>No se encontraron equipos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div id="pagination-controls" class="pagination-controls"></div>
        <button type="submit" class="action-button">Asignar Insumos</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración inicial
            const rowsPerPage = 5;
            const table = document.getElementById('tabla-inventario');
            const tbody = table.querySelector('tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr')); // Todas las filas originales
            let visibleRows = [...allRows]; // Filas visibles actualmente
            const paginationControls = document.getElementById('pagination-controls');
            let currentPage = 1;

            // Filtrar tabla y actualizar paginación
            function filtrarTabla() {
                const filtro = document.getElementById('filtro').value.toLowerCase();

                // Actualizar las filas visibles basadas en el filtro
                visibleRows = allRows.filter(row => {
                    const nombre = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    return nombre.includes(filtro);
                });

                currentPage = 1; // Reiniciar a la primera página al filtrar
                renderTable(); // Actualizar la tabla
            }

            // Renderizar la tabla con paginación
            function renderTable() {
                // Primero, ocultar todas las filas
                allRows.forEach(row => {
                    row.style.display = 'none';
                });

                // Luego, mostrar solo las filas de la página actual
                const startIndex = (currentPage - 1) * rowsPerPage;
                const endIndex = Math.min(startIndex + rowsPerPage, visibleRows.length);

                for (let i = startIndex; i < endIndex; i++) {
                    visibleRows[i].style.display = '';
                }

                renderPaginationControls();
            }

            // Renderizar controles de paginación
            function renderPaginationControls() {
                paginationControls.innerHTML = '';
                const totalPages = Math.ceil(visibleRows.length / rowsPerPage);

                // Si no hay páginas o solo hay una, no mostrar paginación
                if (totalPages <= 1) {
                    return;
                }

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;

                    if (i === currentPage) {
                        button.classList.add('active');
                    }

                    button.addEventListener('click', function() {
                        currentPage = i;
                        renderTable();
                    });

                    paginationControls.appendChild(button);
                }
            }

            // Asignar evento de filtrado al input
            document.getElementById('filtro').addEventListener('keyup', filtrarTabla);

            // Renderizar la tabla inicialmente
            renderTable();
        });
    </script>
</body>

</html>

<?php
// Cierra la conexión
$conexion->close();
?>