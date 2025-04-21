<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
// Consulta a la base de datos para obtener roles de profesor
$sql = "SELECT id, nombre FROM usuarios WHERE rol = 'profesor'";
$resultado = $conexion->query($sql);

$sql1 = "SELECT cod_inventario, nom_inventario FROM inventario WHERE estado = 'Libre'";
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
        <title>Tabla</title>
        <style>
            /* Estilos para el modal */

            html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }

        body{
            font-family: Arial, sans-serif;
        }

        .panel-box {
            max-width: 800px;
            height: 320px;
            position: absolute;
            top: 20%; left:35%;
            padding: 20px;
            width: 350px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
            #myModal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
                padding-top: 60px;
            }
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
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
            top: 60%; left: 25%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
            .custom-button4 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 80%; left: 45%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button4:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .btno {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 80%; left: 31%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btno:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2{
            text-align: center;
        }
        </style>
    </head>
    <body>
    
        <div class = "panel-box">
        <form action="2tabla_inv.php" method="POST">
            <h2>Asignacion de espacios</h2>
            <br>
            <br>
            <div class="rol">
                <label for="profesor">Profesor:</label>
                <select id="profesor" name="profesor">
                    <option value="0" disabled selected>------</option>
                    <?php
                    // Genera dinámicamente las opciones del select
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<option value='{$fila['nombre']}'>{$fila['nombre']}</option>";
                    }
                    ?>
                </select>
                <br>
            </div>
            <br>
            <div class="inventario">
                <label for="inventario">Inventario:</label>
                <select id="inventario" name="inventario">
                    <option value="0" disabled selected>------</option>
                    <?php
                    // Genera dinámicamente las opciones del select
                    while ($fila1 = $resultado1->fetch_assoc()) {
                        echo "<option value='{$fila1['cod_inventario']}'>{$fila1['nom_inventario']}</option>";
                    }
                    ?>
                </select>
               
            </div>
            <br>
            <div>
                <button class="custom-button" type="button" onclick="mostrarModal()">Elegir Fechas y Horas</button>
            </div>
            <br>
            <!-- Modal -->
            <div id="myModal" class="modal" onclick="ocultarModal()">
                <div class="modal-content" onclick="event.stopPropagation();">
                    <label for="fecha_entrega">Fecha de Entrega:</label>
                    <input type="date" id="fecha_entrega" name="fecha_entrega" required>
                    <label for="hora_entrega">Hora de Entrega:</label>
                    <input type="time" id="hora_entrega" name="hora_entrega" required>
                    <br>
                    <label for="fecha_regreso">Fecha de Regreso:</label>
                    <input type="date" id="fecha_regreso" name="fecha_regreso" required>
                    <label for="hora_regreso">Hora de Regreso:</label>
                    <input type="time" id="hora_regreso" name="hora_regreso" required>
                    <br>
                    <button type="button" onclick="ocultarModal()">Guardar Fechas y Horas</button>
                </div>
                <br>
            </div>
            <script>
                function mostrarModal() {
                    document.getElementById('myModal').style.display = 'block';
                }

                function ocultarModal() {
                    document.getElementById('myModal').style.display = 'none';
                }
            </script>
    <input class="btno" type="submit" name="editar"  value="Asignar Espacio">

        </form>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "No se encontraron roles de profesor en la base de datos.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
<a class ="custom-button4" href="verificarpeticionesprofesores.php">Volver atras</a>
