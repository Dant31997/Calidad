<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
// Consulta a la base de datos para obtener roles de profesor
$sql = "SELECT id, nombre FROM usuarios WHERE rol = 'Administrador'";
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
        <title>Asignacion de insumos</title>
    </head>
 <style>
            /* Estilos para el modal */

            html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }

        body{
            font-family: Arial, sans-serif;
        }

        .panel-box {
            width: 300px;
            height: 200px;
            position: absolute;
            top: 20%; left:35%;
            padding: 25px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    
    <body>
    
    <div class = "panel-box">
        <form id="asignarInsumoForm">
            <h2>Asignacion de insumos</h2>
            <br>
            <div class="rol">
                <label for="Nombre_trabajador">Nombre:</label>
                <input type="text" id="Nombre_trabajador" name="Nombre_trabajador" required>
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
                            echo "<option value='{$fila1['cod_inventario']}' data-nom-inventario='{$fila1['nom_inventario']}'>{$fila1['nom_inventario']}</option>";
                        }
                        ?>
                </select>
            <div>
                <input type="hidden" id="estado" name="estado" value="Prestado">
            </div>

                <input class="btno" type="submit" name="editar"  value="Asignar Insumo">
            </div>
        </form>
    </div>
    <script>
            document.getElementById('asignarInsumoForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            const formData = new FormData(this);

            // Obtén el elemento seleccionado del select
            const inventarioSelect = document.getElementById('inventario');
            const selectedOption = inventarioSelect.options[inventarioSelect.selectedIndex];

            // Obtén el valor de data-nom-inventario
            const nomInventario = selectedOption.getAttribute('data-nom-inventario');

            // Agrega nom_inventario al FormData
            formData.append('nom_inventario', nomInventario);

            fetch('procesar_asignacion.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Insumo asignado correctamente.');
                    if (data.reload) {
                        window.location.href = 'verificarPeticionesInsumos.php'; 
                    }
                } else {
                    alert('Error al asignar el insumo: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud.');
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
<a class ="custom-button4" href="verificarPeticionesInsumos.php">Volver atras</a>
