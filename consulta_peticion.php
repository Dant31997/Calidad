<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Peticiones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, white, 70%, #d89785);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            position: absolute;
            top: 20%;
            left: 35%;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        button {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }

        button:hover {
            background-color: #D62828;
        }

        #resultadoConsulta {
            margin-top: 10px;
            background-color: #f9f9f9;
            width: 50%;
            position: absolute;
            top: 1%;
            left: 46%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #resultadoConsulta input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 10px;
        }

        #resultadoConsulta label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            margin-left: 10px;
        }

        #resultadoConsulta h3 {
            margin-left: 10px;
        }

        .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 80%;
            left: 45%;
        }

        .regresar:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Consulta de Peticiones</h1>
        <form method="POST" id="formConsulta">
            <label for="tipoConsulta">Selecciona tipo:</label>
            <select name="tipoConsulta" id="tipoConsulta" required>
                <option value="">-- Selecciona --</option>
                <option value="espacios">Espacio</option>
                <option value="insumos">Insumo</option>
            </select>
            <label for="idPeticion">Ingresa el ID de tu petición:</label>
            <input type="text" name="idPeticion" id="idPeticion" required>
            <button type="submit">Consultar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener referencia al formulario y al selector
            const formulario = document.getElementById('formConsulta');
            const tipoConsulta = document.getElementById('tipoConsulta');

            // Agregar validación al enviar el formulario
            formulario.addEventListener('submit', function(event) {
                event.preventDefault(); // Detener el envío normal

                // Verificar qué opción está seleccionada
                const tipoSeleccionado = tipoConsulta.value;

                if (tipoSeleccionado === '') {
                    alert('Por favor, selecciona un tipo de consulta');
                    return;
                }

                // Establecer la acción adecuada según la selección
                if (tipoSeleccionado === 'espacios') {
                    formulario.action = 'tabla_espacio.php';
                } else if (tipoSeleccionado === 'insumos') {
                    formulario.action = 'tabla_insumo.php';
                }

                // Enviar el formulario
                formulario.submit();
            });
        });
    </script>
    <a class="regresar" href="peticiones_insumos.php">Volver atras</a>
</body>

</html>