<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Captura los datos enviados por la URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
$equipo = isset($_GET['equipo']) ? $_GET['equipo'] : '';
$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : '';
$nom_persona = isset($_GET['nom_persona']) ? $_GET['nom_persona'] : '';
$hora_entrega = isset($_GET['hora_entrega']) ? $_GET['hora_entrega'] : '';
$hora_regreso = isset($_GET['hora_regreso']) ? $_GET['hora_regreso'] : '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Revision de peticion</title>
</head>
<style>
    /* Estilos para el modal */

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

    .panel-box {
        width: 400px;
        height: 420px;
        position: absolute;
        top: 5%;
        left: 30%;
        padding: 10px 25px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        /* Ajusta el valor para cambiar la curvatura de las esquinas */
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
        top: 60%;
        left: 25%;
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
        top: 90%;
        left: 41%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-button4:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btno {
        display: inline-block;
        padding: 10px 20px;
        background-color: green;
        color: #FFF;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        top: 86%;
        left: 25%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-color: transparent;
    }

    .btno:hover {
        background-color: greenyellow;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        top: 86%;
        left: 52%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-color: transparent;
    }

    .btno2:hover {
        background-color: #D62828;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: red;
        margin-top: 10px;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    .tabla-container {
        width: 400px;
        height: 350px;
        position: absolute;
        top: 12%;
        right: 1%;
        padding: 5px 10px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .tabla-resumen {
        width: 100%;
        border-collapse: collapse;
    }

    .tabla-resumen th {
        background-color: #ff0000;
        color: white;
        padding: 12px;
        text-align: center;
        border-radius: 5px;
    }

    .tabla-resumen td {
        padding: 10px;
        text-align: center;
        background-color: #fff;
        border-radius: 5px;
    }

    .tabla-resumen tr:hover td {
        background-color: #f5f5f5;
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

    .pagination2 {
        text-align: center;
        position: absolute;
        top: 90%;
        left: 48%;
    }

    .pagination2 a {
        display: inline-flexbox;
        padding: 5px 10px;
        margin-left: 1%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        text-decoration: none;
        color: #000;
    }

    .pagination2 a.active2 {
        background-color: #ff0000;
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    input[type="text"],
    select {
        width: 95%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    select:focus {
        border-color: #ff0000;
        box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
        outline: none;
    }

    input[readonly] {
        width: 95%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        transition: all 0.3s ease;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        font-size: 14px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* Dos columnas de igual tamaño */
        gap: 20px;
        /* Espaciado entre columnas y filas */
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-actions {
        margin-top: 20px;
        text-align: center;
        grid-column: span 2;
        /* Hace que las acciones ocupen ambas columnas */
    }
</style>

<body>
    <div class="panel-box">
        <form id="asignarInsumoForm" action="procesar_asignacion.php" method="POST">
            <h2>Revision de peticion</h2>
            <br>
            <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="Nombre_trabajador">Nombre:</label>
            <input  readonly type="text" id="Nombre_trabajador" name="Nombre_trabajador" value="<?php echo htmlspecialchars($nom_persona); ?>" required>
            <div class="form-grid">
                <div class="form-group">
                    <label for="inventario">Inventario:</label>
                    <input type="text" id="inventario" name="inventario" value="<?php echo htmlspecialchars($equipo); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="text" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($cantidad); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="Hora_entrega">Hora de entrega:</label>
                    <input type="time" id="Hora_entrega" name="Hora_entrega" value="<?php echo htmlspecialchars($hora_entrega); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="Hora_regreso">Hora de regreso:</label>
                    <input type="time" id="Hora_regreso" name="Hora_regreso" value="<?php echo htmlspecialchars($hora_regreso); ?>" readonly>
                </div>

                <input type="hidden" id="estado" name="estado" value="Prestado">
            </div>
            <div class="form-actions">
                <input class="btno" type="submit" name="editar" value="Aceptar">
                <a title="Rechazar" class="btno2 eliminar-btn" href="rechazarPeticionInsumo.php?id=<?php echo $id; ?>">
                    Rechazar
                </a>
            </div>
        </form>
    </div>

    <div class="tabla-container">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Carga inicial de la tabla usando fetch
                fetch('tabla_inventario.php?ajax=true')
                    .then(response => response.text())
                    .then(html => {
                        // Inserta el contenido de la tabla en el contenedor
                        document.querySelector('.tabla-container').innerHTML = html;

                        // Registra el evento de paginación después de cargar el contenido
                        agregarEventoPaginacion();
                    })
                    .catch(error => console.error('Error al cargar la tabla:', error));
            });

            function agregarEventoPaginacion() {
                const paginationContainer = document.querySelector('.pagination2');

                if (paginationContainer) {
                    // Delegación de eventos para manejar clics en los enlaces de paginación
                    paginationContainer.addEventListener('click', function(event) {
                        if (event.target.tagName === 'A') {
                            event.preventDefault(); // Evita el comportamiento predeterminado del enlace

                            const pagina2 = event.target.getAttribute('data-pagina2');

                            // Realiza la solicitud AJAX
                            fetch(`tabla_inventario.php?pagina2=${pagina2}&ajax=true`)
                                .then(response => response.text())
                                .then(html => {
                                    // Reemplaza el contenido de la tabla y la paginación
                                    document.querySelector('.tabla-container').innerHTML = html;

                                    // Vuelve a registrar el evento de paginación
                                    agregarEventoPaginacion();
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                }
            }
        </script>
    </div>
</body>

</html>
<?php

// Cierra la conexión a la base de datos
$conexion->close();
?>
<a class="custom-button4" href="verificarPeticionesInsumos.php">Volver atras</a>