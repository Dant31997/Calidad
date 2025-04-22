<?php
$title = "PRÉSTAMOS DE INSUMOS";
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
            margin-top: 2%;
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
            left: 45%;
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
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            margin-left: 20px;
            border-collapse: collapse;
        }
        th {
            font-size: 13px;
            font-weight: normal;
            padding: 8px;
            border-top: 4px solid #FC472F;
            border-bottom: 1px solid black;
            color: white;
            font-weight: bold;
        }
        td {
            padding: 8px;
            background: white;
            border-bottom: 1px solid #fff;
            color: black;
            border-top: 1px solid black;
            border-color: #333;
        }
        tr:hover td {
            background: #d0dafd;
            color: #339;
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
        .tabla1 {
            margin-top: 7%;
        }
        .encabezado {
            background-color: red;
        }
        .pagination {
        text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border: 1px solid #d0dafd;
            text-decoration: none;
            color: #000;
        }

        .pagination a.active {
            background-color: #ff0000;
            color: #fff;
            border: 1px solid #000;
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

        form input, form select {
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
    <!-- Modal -->
<div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Préstamo</h2>
        <form id="editForm" method="POST" action="actualizar_prestamo.php">
            <input type="hidden" name="id_prestamo" id="id_prestamo">
            <label for="insumo">Insumo:</label>
            <input type="text" name="insumo" id="insumo" required>
            <br>
            <label for="nombre_persona_prestamo">Nombre de la Persona:</label>
            <input type="text" name="nombre_persona_prestamo" id="nombre_persona_prestamo" required>
            <br>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="Prestado">Prestado</option>
                <option value="Devuelto">Devuelto</option>
            <br>
            <label for="dia_prestamo">Día del Préstamo:</label>
            <input type="date" name="dia_prestamo" id="dia_prestamo" required>
            <br>
            <label for="hora_prestamo">Hora del Préstamo:</label>
            <input type="time" name="hora_prestamo" id="hora_prestamo" required>
            <br>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>

<script>
    // Obtener elementos del DOM
    const modal = document.getElementById("editModal");
    const closeModal = document.querySelector(".close");
    const editForm = document.getElementById("editForm");

    // Función para abrir el modal con los datos del registro
    function openModal(id, insumo, nombre, estado, dia, hora) {
        document.getElementById("id_prestamo").value = id;
        document.getElementById("insumo").value = insumo;
        document.getElementById("nombre_persona_prestamo").value = nombre;
        document.getElementById("estado").value = estado;
        document.getElementById("dia_prestamo").value = dia;
        document.getElementById("hora_prestamo").value = hora;
        modal.style.display = "block";
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

    $registrosPorPagina = 6;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;
    $sql = "SELECT * FROM prestamos_insumos LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);

    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM prestamos_insumos")->fetch_assoc()['total'];

    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

    if ($resultado->num_rows >= 0) {
        echo "<div class='panel-box-admin'>";
        echo "<h2 class='title1' align='center'>$title</h2>";
        echo "</div>";

        echo "<div class='tabla1'>";
        echo "<table border='1'>";
        echo "<tr class='encabezado'>
        <th style='width:150px;'>Insumo</th>
        <th style='width:200px;'>Nombre de la Persona</th>
        <th style='width:100px;'>Estado</th>
        <th style='width:150px;'>Día del Préstamo</th>
        <th style='width:150px;'>Hora del Préstamo</th>
        <th style='width:150px;'>Acciones</th>
        </tr>";

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['insumo'] . "</td>";
            echo "<td>" . $fila['nombre_persona_prestamo'] . "</td>";
            echo "<td>" . $fila['estado'] . "</td>";
            echo "<td>" . $fila['dia_prestamo'] . "</td>";
            echo "<td>" . $fila['hora_prestamo'] . "</td>";
            echo "<td>
                <button onclick=\"openModal('" . $fila['id_prestamo'] . "', '" . $fila['insumo'] . "', '" . $fila['nombre_persona_prestamo'] . "', '" . $fila['estado'] . "', '" . $fila['dia_prestamo'] . "', '" . $fila['hora_prestamo'] . "')\">Editar</button>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
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