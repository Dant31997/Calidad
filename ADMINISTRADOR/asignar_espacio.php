<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
$pide = isset($_GET['pide']) ? $_GET['pide'] : '';
$nom_espacio = isset($_GET['nom_espacio']) ? $_GET['nom_espacio'] : '';
$hora_entrega = isset($_GET['hora_entrega']) ? $_GET['hora_entrega'] : '';
$hora_regreso = isset($_GET['hora_regreso']) ? $_GET['hora_regreso'] : '';
$fecha_entrega = isset($_GET['fecha_entrega']) ? $_GET['fecha_entrega'] : '';

$sql = "SELECT id, nombre FROM usuarios WHERE rol = 'Funcionario'";
$resultado = $conexion->query($sql);

$sql1 = "SELECT cod_espacio, nom_espacio FROM espacios WHERE estado_espacio = 'Libre'";
$resultado1 = $conexion->query($sql1);


// Comprueba si hay resultados
if ($resultado->num_rows > 0) {
    // Imprime la etiqueta de conexión


    // Imprime el formulario HTML
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Asignacion de espacios</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            /* Base styles */
            :root {
                --primary-color: #ff0000;
                --primary-hover: #D62828;
                --background-gradient: linear-gradient(to bottom, white 10%, #FADBD8);
                --box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                --border-radius: 8px;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                height: 100%;
                font-family: 'Segoe UI', Arial, sans-serif;
                background: var(--background-gradient);
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            /* Form container styling */
            .panel-box {
                width: 350px;
                margin-top: 20px;
                margin-left: -700px;
                padding: 20px;
                background-color: #fff;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
            }

            /* Form header */
            h2 {
                text-align: center;
                color: var(--primary-color);
                margin-top: -20px;
                margin-bottom: 25px;
                padding-bottom: 10px;
                border-bottom: 2px solid #f0f0f0;
            }

            /* Form fields styling */
            form div {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #333;
            }

            input[type="text"],
            input[type="date"],
            input[type="time"],
            select {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: var(--border-radius);
                font-size: 15px;
                box-sizing: border-box;
                transition: border-color 0.3s;
            }

            input[type="text"]:focus,
            input[type="date"]:focus,
            input[type="time"]:focus,
            select:focus {
                border-color: var(--primary-color);
                outline: none;
                box-shadow: 0 0 5px rgba(255, 0, 0, 0.2);
            }

            /* Buttons styling */
            .button-container {
                display: flex;
                justify-content: center;
                margin-top: 30px;
            }

            .btn,
            .btno,
            .custom-button4 {
                display: inline-block;
                padding: 12px 25px;
                background-color: var(--primary-color);
                color: #FFF;
                text-decoration: none;
                border-radius: var(--border-radius);
                font-size: 16px;
                border: none;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.2s;
                margin: -10px 5px;
                text-align: center;
            }

            .btn:hover,
            .btno:hover,
            .custom-button4:hover {
                background-color: var(--primary-hover);
                transform: translateY(-2px);
            }

            .navigation-buttons {
                display: flex;
                justify-content: center;
                margin-top: 20px;
                margin-bottom: 40px;
            }

            .time-inputs-container {
                display: flex;
                justify-content: space-between;
                gap: 15px;
                margin-bottom: 20px;
            }

            .time-input {
                flex: 1;
                margin-bottom: 0;
            }

            .time-input input {
                width: 100%;
            }

            .btno2 {
                display: inline-block;
                padding: 10px 20px;
                background-color: #ff0000;
                color: #FFF;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                position: absolute;
                top: 73.5%;
                left: 25%;
                transition: background-color 0.3s, transform 0.2s;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-color: transparent;
            }

            .btno2:hover {
                background-color: #D62828;
                transform: translateY(-2px);
            }

            .table-container {
                background-color: white;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
                padding: 5px 20px;
                overflow: hidden;
                position: absolute;
                top: -2%;
                right: 2%;
            }

            .table-container h2 {
                margin-top: 0;
            }

            .reservations-table {
                width: 100%;
                border-collapse: collapse;
            }

            .reservations-table th,
            .reservations-table td {
                padding: 12px 15px;
                text-align: center;
                border-bottom: 1px solid #f0f0f0;
            }

            .reservations-table th {
                background-color: var(--primary-color);
                color: white;
                font-weight: 600;
            }

            .reservations-table tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .reservations-table tr:hover {
                background-color: #f1f1f1;
            }

            /* Pagination styles */
            .pagination {
                display: flex;
                justify-content: center;
                list-style: none;
                padding: 0;
                margin: 20px 0 0 0;
            }

            .pagination li {
                margin: 0 5px;
            }

            .pagination a {
                display: block;
                padding: 8px 12px;
                text-decoration: none;
                color: #333;
                border: 1px solid #ddd;
                border-radius: 4px;
                transition: all 0.3s;
            }

            .pagination a:hover {
                background-color: #f5f5f5;
            }

            .pagination .active a {
                background-color: var(--primary-color);
                color: white;
                border-color: var(--primary-color);
            }

            .pagination .disabled a {
                color: #ccc;
                cursor: not-allowed;
            }
        </style>
    </head>

    <body>
        <div class="panel-box">
            <form id="asignarInsumoForm">
                <h2>Revisión de petición</h2>
                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <div>
                    <label for="Nombre_trabajador">Encargado:</label>
                    <input readonly type="text" id="Nombre_trabajador" name="Nombre_trabajador" value="<?php echo htmlspecialchars($pide); ?>" required>
                </div>

                <div>
                    <label for="nom_espacio">Espacio:</label>
                    <input readonly type="text" id="nom_espacio" name="nom_espacio" value="<?php echo htmlspecialchars($nom_espacio); ?>" required>
                </div>

                <div>
                    <label for="fecha_entrega">Fecha de Uso:</label>
                    <input readonly type="date" id="fecha_entrega" name="fecha_entrega" value="<?php echo htmlspecialchars($fecha_entrega); ?>">
                </div>

                <div class="time-inputs-container">
                    <div class="time-input">
                        <label for="desde">Desde:</label>
                        <input readonly type="time" id="desde" name="desde" value="<?php echo htmlspecialchars($hora_entrega); ?>">
                    </div>

                    <div class="time-input">
                        <label for="hasta">Hasta:</label>
                        <input readonly type="time" id="hasta" name="hasta" value="<?php echo htmlspecialchars($hora_regreso); ?>">
                    </div>
                </div>

                <div class="button-container">
                    <input style="background: green; margin-right: 135px;" class="btno" type="submit" name="editar" value="Aceptar">
                    <a title="Rechazar" class="btno2 eliminar-btn" href="rechazarPeticionInsumo.php?id=<?php echo $id; ?>">
                        Rechazar
                    </a>
                </div>
            </form>
        </div>

        <div class="navigation-buttons">
            <a class="custom-button4" href="verificarPeticionesEspacios.php">Volver atrás</a>
        </div>

        <!-- Dynamic table for space reservations -->
        <div class="table-container" style="width: 90%; max-width: 750px; margin: 30px auto;">
            <h2>Reservas actuales para este espacio</h2>

            <?php
            // Configuración de la paginación
            $registros_por_pagina = 5;
            $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_actual - 1) * $registros_por_pagina;

            // Consulta para contar el total de registros
            $sql_count = "SELECT COUNT(*) as total FROM prestamos_espacios WHERE estado = 'Reservado' AND espacio = ?";
            $stmt_count = $conexion->prepare($sql_count);
            $stmt_count->bind_param("s", $nom_espacio);
            $stmt_count->execute();
            $resultado_count = $stmt_count->get_result();
            $fila_count = $resultado_count->fetch_assoc();
            $total_registros = $fila_count['total'];

            // Calcular número total de páginas
            $total_paginas = ceil($total_registros / $registros_por_pagina);

            // Consulta para obtener los registros de la página actual
            $sql = "SELECT espacio, nom_persona, estado, fecha_entrega, desde, hasta 
                    FROM prestamos_espacios 
                    WHERE estado = 'Reservado' AND espacio = ? 
                    ORDER BY fecha_entrega DESC, desde ASC 
                    LIMIT ? OFFSET ?";

            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sii", $nom_espacio, $registros_por_pagina, $offset);
            $stmt->execute();
            $resultado_tabla = $stmt->get_result();

            if ($resultado_tabla->num_rows > 0):
            ?>

                <table class="reservations-table">
                    <thead>
                        <tr>
                            <th>Nombre del Espacio</th>
                            <th>Encargado</th>
                            <th>Estado</th>
                            <th>Fecha de Préstamo</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = $resultado_tabla->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila['espacio']); ?></td>
                                <td><?php echo htmlspecialchars($fila['nom_persona']); ?></td>
                                <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                                <td><?php
                                    $fecha = new DateTime($fila['fecha_entrega']);
                                    echo htmlspecialchars($fecha->format('d/m/Y'));
                                    ?></td>
                                <td><?php
                                    $hora_desde = new DateTime($fila['desde']);
                                    echo htmlspecialchars($hora_desde->format('h:i A'));
                                    ?></td>
                                <td><?php
                                    $hora_hasta = new DateTime($fila['hasta']);
                                    echo htmlspecialchars($hora_hasta->format('h:i A'));
                                    ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Paginación -->
                <?php if ($total_paginas > 1): ?>
                    <ul class="pagination">
                        <!-- Botón anterior -->
                        <li class="<?php echo $pagina_actual <= 1 ? 'disabled' : ''; ?>">
                            <a href="<?php
                                        $params = $_GET;
                                        $params['pagina'] = $pagina_actual - 1;
                                        echo $pagina_actual <= 1 ? '#' : '?' . http_build_query($params);
                                        ?>">
                                &laquo; Anterior
                            </a>
                        </li>

                        <!-- Números de página -->
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="<?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                                <a href="<?php
                                            $params = $_GET;
                                            $params['pagina'] = $i;
                                            echo '?' . http_build_query($params);
                                            ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Botón siguiente -->
                        <li class="<?php echo $pagina_actual >= $total_paginas ? 'disabled' : ''; ?>">
                            <a href="<?php
                                        $params = $_GET;
                                        $params['pagina'] = $pagina_actual + 1;
                                        echo $pagina_actual >= $total_paginas ? '#' : '?' . http_build_query($params);
                                        ?>">
                                Siguiente &raquo;
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>

            <?php else: ?>
                <div style="text-align: center; padding: 20px;">
                    <p>No hay reservas actuales para este espacio.</p>
                </div>
            <?php
            endif;

            // Cerrar las declaraciones preparadas
            if (isset($stmt)) $stmt->close();
            if (isset($stmt_count)) $stmt_count->close();
            ?>
        </div>

        <script>
            document.getElementById('asignarInsumoForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evita el envío tradicional del formulario

                const formData = new FormData(this);

                // Mostrar loader mientras se procesa
                Swal.fire({
                    title: 'Procesando',
                    text: 'Asignando espacio...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch('procesar_asignacion_espacio.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error HTTP: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Mensaje de éxito
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'El espacio ha sido asignado correctamente',
                                confirmButtonColor: '#28a745',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed && data.reload) {
                                    window.location.href = 'verificarPeticionesEspacios.php';
                                }
                            });
                        } else {
                            // Mensaje de error
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Ocurrió un error al asignar el espacio',
                                confirmButtonColor: '#ff0000',
                                confirmButtonText: 'Entendido'
                            });
                        }
                    })
                    .catch(error => {
                        // Network or other error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de conexión',
                            text: 'No se pudo conectar con el servidor. Por favor intente nuevamente.',
                            footer: 'Detalles: ' + error.message,
                            confirmButtonColor: '#ff0000',
                            confirmButtonText: 'Cerrar'
                        });
                        console.error('Error:', error);
                    });
            });

            document.querySelector('.eliminar-btn').addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');

                Swal.fire({
                    title: '¿Está seguro?',
                    text: "¿Desea rechazar esta petición de espacio?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, rechazar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    echo "No se encontraron roles de estudiante en la base de datos.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>