<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Peticiones</title>
    <style>
        html {
            background: linear-gradient(to bottom, white, 70%, #d89785);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        form {
            max-width: 500px;
            width: 450px;
            margin: auto;
            margin-top: 13%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="time"] {
            /* Estilos específicos para los inputs tipo time */
            width: 30%;
            /* Ajusta el ancho según sea necesario */
            padding: 5px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button:hover {
            background-color: #ccc;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            text-align: center;
            background-color: red;
            padding: 5px;
            border-radius: 5px;
            width: 25%;
            /* Ajusta el ancho del contenedor */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: white;
            position: absolute;
            top: 1%;
            left: 37.5%;
        }

        .container h1 {
            font-size: 24px;
            color: white;
        }

        .boton_consulta {
            position: absolute;
            /* Posición absoluta */
            top: 10px;
            /* Ajusta la distancia desde la parte superior */
            right: 200px;
            /* Ajusta la distancia desde la parte derecha */
            background-color: red;
            width: 10%;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Sombra para un mejor diseño */
        }

        .boton_consulta:hover {
            background-color: rebeccapurple;
            /* Cambia el color al pasar el mouse */
        }

        .boton_consulta:active {
            background-color: red;
            /* Cambia el color al hacer clic */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Formulario de Peticiones</h1>
    </div>
    <form id="miFormulario" method="post">
        <label for="tipo">Selecciona tipo:</label>
        <select name="tipo" id="tipo" onchange="mostrarOpciones()">
            <option value="">-- Selecciona --</option>
            <option value="espacio">Espacio</option>
            <option value="insumo">Insumo</option>
        </select>
        <!--- espacio--->
        <div id="opcionesEspacio" style="display:none; margin-top: 10px;">
            <label for="pide">¿Cual es tu nombre?:</label>
            <input type="text" name="pide" id="pide">
            <br>
            <label for="nom_espacio">¿Cual espacio deseas solicitar?:</label>
            <select id="nom_espacio" name="nom_espacio">
                <option value="0" disabled selected>------</option>
                <?php
                $conexion = new mysqli("localhost", "root", "", "basededatos");

                // Verifica la conexión
                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }

                $sql = "SELECT cod_espacio, nom_espacio FROM espacios ";
                $resultado = $conexion->query($sql);
                // Genera dinámicamente las opciones del select
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value='{$fila['nom_espacio']}' data-cod-espacio='{$fila['cod_espacio']}'>{$fila['nom_espacio']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="fecha_entrega">¿Que dia necesitas el espacio?</label>
            <input type="date" name="fecha_entrega" id="fecha_entrega">
            <br>
            <label for="hora_entrega_espacio" style="display: inline-block; margin-right: 10px;">¿En qué horario necesitas el espacio?</label>
            <br>
            <input type="time" name="hora_entrega_espacio" id="hora_entrega_espacio" style="display: inline-block; margin-right: 10px;">
            <label for="" style="display: inline-block; margin-right: 10px;">hasta</label>
            <input type="time" name="hora_regreso_espacio" id="hora_regreso_espacio" style="display: inline-block;">
        </div>
        <!--- insumos--->
        <div id="opcionesInsumo" style="display:none; margin-top: 10px;">
            <label for="nom_persona">¿Cual es tu nombre?:</label>
            <input type="text" name="nom_persona" id="nom_persona">
            <br>
            <label for="equipo">¿Qué insumo deseas solicitar?:</label>
            <select id="equipo" name="equipo">
                <option value="0" disabled selected>------</option>
                <?php
                $conexion2 = new mysqli("localhost", "root", "", "basededatos");

                // Verifica la conexión
                if ($conexion2->connect_error) {
                    die("Error en la conexión: " . $conexion2->connect_error);
                }

                $sql2 = "SELECT cod_inventario, nom_inventario FROM inventario WHERE estado = 'Libre'";
                $resultado2 = $conexion2->query($sql2);
                // Genera dinámicamente las opciones del select
                while ($fila2 = $resultado2->fetch_assoc()) {
                    echo "<option value='{$fila2['nom_inventario']}' data-cod-inventario='{$fila2['nom_inventario']}'>{$fila2['nom_inventario']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="cantidad">¿Cuantos insumos deseas solicitar?:</label>
            <input type="text" name="cantidad" id="cantidad">
            <br>
            <label for="hora_entrega">¿En qué horario necesitas el insumo?</label>
            <br>
            <input type="time" name="hora_entrega" id="hora_entrega" style="display: inline-block; margin-right: 10px;">
            <label for="" style="display: inline-block; margin-right: 10px;">hasta</label>
            <input type="time" name="hora_regreso" id="hora_regreso" style="display: inline-block;">
        </div>
        <button type="submit" style="margin-top: 20px;">Enviar</button>
    </form>

    <script>
        function mostrarOpciones() {
            var tipoSeleccionado = document.getElementById('tipo').value;
            var formulario = document.getElementById('miFormulario');

            // Ocultamos todo primero
            document.getElementById('opcionesEspacio').style.display = 'none';
            document.getElementById('opcionesInsumo').style.display = 'none';

            // Mostramos y cambiamos acción según la selección
            if (tipoSeleccionado === 'espacio') {
                document.getElementById('opcionesEspacio').style.display = 'block';
                formulario.action = 'procesar_peticion_espacios.php'; // Acción para espacios
            } else if (tipoSeleccionado === 'insumo') {
                document.getElementById('opcionesInsumo').style.display = 'block';
                formulario.action = 'procesar_peticion.php'; // Acción para insumos
            } else {
                formulario.action = ''; // Si no elige nada, no ponemos acción
            }
        }
    </script>
    <button class="boton_consulta" onclick="window.location.href='consulta_peticion.html'" style="margin-top: 20px; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">
        Consultar Petición
    </button>
</body>

</html>