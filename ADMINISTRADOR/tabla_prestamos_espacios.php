<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtener el nombre del espacio desde la URL si existe, si no usar una variable
$nom_espacio = isset($_GET['nom_espacio']) ? $_GET['nom_espacio'] : '';

// Configuración de la paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Consulta para contar el total de registros que cumplen con la condición
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
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamos de Espacios</title>
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
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--background-gradient);
            min-height: 100vh;
        }

        /* Container styling */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        /* Table styling */
        .table-container {
            overflow-x: auto;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 20px 0;
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

        /* No results message */
        .no-results {
            text-align: center;
            padding: 30px;
            font-size: 16px;
            color: #666;
        }

        /* Back button */
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .back-button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Préstamos del Espacio: <?php echo htmlspecialchars($nom_espacio); ?></h1>
        
        <?php if ($resultado->num_rows > 0): ?>
            <div class="table-container">
                <table>
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
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila['espacio']); ?></td>
                                <td><?php echo htmlspecialchars($fila['nom_persona']); ?></td>
                                <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                                <td><?php echo htmlspecialchars($fila['fecha_entrega']); ?></td>
                                <td><?php echo htmlspecialchars($fila['desde']); ?></td>
                                <td><?php echo htmlspecialchars($fila['hasta']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <?php if ($total_paginas > 1): ?>
                <ul class="pagination">
                    <!-- Botón anterior -->
                    <li class="<?php echo $pagina_actual <= 1 ? 'disabled' : ''; ?>">
                        <a href="<?php echo $pagina_actual <= 1 ? '#' : '?nom_espacio=' . urlencode($nom_espacio) . '&pagina=' . ($pagina_actual - 1); ?>">
                            &laquo; Anterior
                        </a>
                    </li>
                    
                    <!-- Números de página -->
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="<?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                            <a href="?nom_espacio=<?php echo urlencode($nom_espacio); ?>&pagina=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    
                    <!-- Botón siguiente -->
                    <li class="<?php echo $pagina_actual >= $total_paginas ? 'disabled' : ''; ?>">
                        <a href="<?php echo $pagina_actual >= $total_paginas ? '#' : '?nom_espacio=' . urlencode($nom_espacio) . '&pagina=' . ($pagina_actual + 1); ?>">
                            Siguiente &raquo;
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            
        <?php else: ?>
            <div class="no-results">
                <p>No se encontraron préstamos para este espacio.</p>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center;">
            <a href="asignar_espacio.php" class="back-button">Volver</a>
        </div>
    </div>
</body>
</html>

<?php
// Cierra las conexiones
$stmt->close();
$stmt_count->close();
$conexion->close();
?>