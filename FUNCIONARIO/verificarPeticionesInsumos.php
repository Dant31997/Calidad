<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Peticiones</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
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

        .panel-box-admin {
            width: 100%;
            height: 60px;
            position: absolute;
            padding-bottom: 8px;
            top: 0%;
            left: 0%;
            background-color: red;
            border-bottom: #943126 10px solid;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: white;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }

        .tabla1 {
            position: absolute;
            top: 13%;
            left: 1%;
            padding: 10px;
            width: 1280px;
            height: 800px;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 13px;
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

        .custom-button2 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D62828;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 2%;
            left: 85%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .custom-button2:hover {
            background-color: #943126;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .encabezado {
            background-color: red;
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
            left: 5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button3:hover {
            background-color: #943126;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* CSS para el modal */
        #asignarModal {
            display: none;
            /* Oculto por defecto */
            position: fixed;
            z-index: 1000;
            /* Asegura que esté por encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            /* Habilita el scroll si el contenido es demasiado grande */
            background-color: rgba(0, 0, 0, 0.5);
            /* Fondo semitransparente */
        }

        #asignarModal>div {
            background-color: white;
            margin: 15% auto;
            /* Centra el modal verticalmente */
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
            /* Animación de entrada */
        }

        #asignarModal h3 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        #asignarModal label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        #asignarModal input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #asignarModal button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        #asignarModal button[type="submit"] {
            background-color: #28a745;
            color: white;
            margin-right: 10px;
        }

        #asignarModal button[type="submit"]:hover {
            background-color: #218838;
        }

        #asignarModal button#closeModal {
            background-color: #dc3545;
            color: white;
        }

        #asignarModal button#closeModal:hover {
            background-color: #c82333;
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        select {
            width: 100%;
            /* Ajusta el ancho al contenedor */
            padding: 10px;
            /* Espaciado interno */
            margin-bottom: 15px;
            /* Espaciado inferior */
            border: 1px solid #ccc;
            /* Borde gris claro */
            border-radius: 5px;
            /* Bordes redondeados */
            background-color: #f9f9f9;
            /* Fondo claro */
            font-size: 14px;
            /* Tamaño de fuente */
            color: #333;
            /* Color del texto */
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            /* Sombra interna */
            appearance: none;
            /* Oculta el estilo predeterminado del navegador */
            -webkit-appearance: none;
            /* Compatibilidad con WebKit */
            -moz-appearance: none;
            /* Compatibilidad con Firefox */
            cursor: pointer;
            /* Cambia el cursor al pasar */
        }

        /* Icono de flecha personalizado para el select */
        select:focus {
            outline: none;
            /* Elimina el borde azul al enfocar */
            border-color: #007bff;
            /* Cambia el color del borde al enfocar */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Sombra azul al enfocar */
        }

        /* Efecto hover */
        select:hover {
            background-color: #f1f1f1;
            /* Fondo más claro al pasar el mouse */
            border-color: #bbb;
            /* Cambia el color del borde */
        }
    </style>
</head>

<body>
    <div class="panel-box-admin">
        <h2>PETICIONES DE INSUMOS</h2>
    </div>

    <!-- Modal para asignar insumo -->
    <div id="asignarModal" style="display: none;">
        <div style="background: white; padding: 20px; border-radius: 10px; width: 400px; margin: auto; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
            <h3>Asignar Insumo</h3>
            <form action="asignar_insumo.php" method="POST">
                <input type="hidden" name="id" id="modal-id">
                <label for="nom_persona">Nombre de la persona:</label>
                <input type="text" name="nom_persona" id="modal-nom_persona"> </input>
                <label for="inventario">Insumo:</label>
                <select id="inventario" name="inventario">
                    <option value="0" disabled selected>------</option>
                    <?php
                    $conexion2 = new mysqli("localhost", "root", "", "basededatos");

                    // Verifica la conexión
                    if ($conexion2->connect_error) {
                        die("Error en la conexión: " . $conexion2->connect_error);
                    }

                    $sql1 = "SELECT cod_inventario, nom_inventario FROM inventario WHERE estado = 'Libre'";
                    $resultado1 = $conexion2->query($sql1);
                    // Genera dinámicamente las opciones del select
                    while ($fila1 = $resultado1->fetch_assoc()) {
                        echo "<option value='{$fila1['cod_inventario']}' data-nom-inventario='{$fila1['nom_inventario']}'>{$fila1['nom_inventario']}</option>";
                    }
                    ?>
                </select>
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad">
                <br><br>
                <button type="submit">Asignar</button>
                <button type="button" style="background-color: orange; color:white">Rechazar</button>
                <button type="button" id="closeModal">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const asignarButtons = document.querySelectorAll('.asignar-btn');
            const modal = document.getElementById('asignarModal');
            const closeModal = document.getElementById('closeModal');
            const modalId = document.getElementById('modal-id');
            const modalNom_persona = document.getElementById('modal-nom_persona');
            const modalCantidad = document.getElementById('cantidad');
            const inventarioSelect = document.getElementById('inventario');
            const inventarioNom = document.querySelectorAll('option[data-nom-inventario]');
            const messageContainer = document.createElement('p'); // Contenedor para el mensaje
            messageContainer.style.color = 'red';
            modal.appendChild(messageContainer);

            asignarButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    modalId.value = this.dataset.id; // Asigna el ID al campo oculto
                    modalNom_persona.value = this.dataset.nom_persona; // Asigna nom_persona al campo de texto
                    modalCantidad.value = this.dataset.cantidad; // Asigna cantidad al campo de texto
                    modal.style.display = 'block'; // Muestra el modal
                });
            });

            closeModal.addEventListener('click', function() {
                modal.style.display = 'none'; // Oculta el modal al hacer clic en "Cancelar"
                messageContainer.textContent = ''; // Limpia el mensaje
            });

            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none'; // Oculta el modal al hacer clic fuera de él
                    messageContainer.textContent = ''; // Limpia el mensaje
                }
            });

            // Evento para verificar la cantidad de insumos
            inventarioSelect.addEventListener('change', function() {
                const selectedValue = inventarioSelect.options[inventarioSelect.selectedIndex].getAttribute('data-nom-inventario');
                const cantidad = modalCantidad.value;
                console.log('Selected Value:', selectedValue);
                console.log('Cantidad:', cantidad);

                if (selectedValue && cantidad) {
                    fetch('verificar_insumos.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                nom_inventario: selectedValue,
                                cantidad: cantidad
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (data.suficiente) {
                                    messageContainer.textContent = 'Hay suficientes insumos para el préstamo.';
                                    messageContainer.style.color = 'green';
                                } else {
                                    messageContainer.textContent = 'No hay suficientes insumos para cubrir el préstamo.';
                                    messageContainer.style.color = 'red';
                                }
                            } else {
                                messageContainer.textContent = 'Error al verificar los insumos.';
                                messageContainer.style.color = 'red';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            messageContainer.textContent = 'Error al realizar la consulta.';
                            messageContainer.style.color = 'red';
                        });
                }
            });
        });
    </script>
    <?php
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $registrosPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;

    // Consulta SQL con LIMIT para obtener registros de la página actual y filtrar por estado_peticion
    $sql = "SELECT * FROM peticiones_insumos WHERE estado_peticion = 'Sin Revisar' LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);

    // Consulta SQL para obtener el número total de registros con estado "Sin Revisar"
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM peticiones_insumos WHERE estado_peticion = 'Sin Revisar'")->fetch_assoc()['total'];

    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);


    if ($resultado->num_rows > 0) {

        echo "<div class='tabla1'>";
        echo "<table>";
        echo "<tr class='encabezado' ><th style=width:50px;>ID</th>
        <th style=width:100px;>Equipo</th>
        <th style=width:100px;>Cantidad</th>
        <th style=width:280px;>Nombre de la persona</th>
        <th style=width:150px;>Estado de la peticion</th>
        <th style=width:130px>Fecha</th>
        <th style=width:100px;>Hora de Salida</th>
        <th style=width:100px;>Hora de Devolucion</th>
        <th style=width:80px;>Acciones</th> </tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['equipo'] . "</td>";
            echo "<td>" . $fila['cantidad'] . "</td>";
            echo "<td>" . $fila['nom_persona'] . "</td>";
            echo "<td>" . $fila['estado_peticion'] . "</td>";
            echo "<td>" . $fila['dia_entrega'] . "</td>";
            echo "<td>" . $fila['hora_entrega'] . "</td>";
            echo "<td>" . $fila['hora_regreso'] . "</td>";
            echo "<td>  
                        <a title='Asignar' class='asignar-btn' style='margin-right: 1px;' href='#' data-id='" . $fila['id'] . "' data-nom_persona='" . $fila['nom_persona'] . "'. data-cantidad='" . $fila['cantidad'] . "'><img src='imagenes/asignar.png' alt='Asignar' /></a>
                        </td>";

            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No hay usuarios en la base de datos.";
    }
    ?>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='verificarPeticionesInsumos.php?pagina=$i'>$i</a>";
        }
        ?>
    </div>


    <a class="custom-button2" href="funcionario.php">Volver al inicio</a>
    <a class="custom-button3" href="asignar_Insumo.php">Asignar Insumo</a>
</body>

</html>