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
            top: 3%;
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
            margin-top: 20px;
            display: none;
            background-color: #f9f9f9;
            width: 30%;
            position: absolute;
            top: 1%;
            left: 68%;
            order-radius: 5px;
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
            top: 89%;
            left: 45%;
        }

        .regresar:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>

<body>
    <div class="form-container">
        <h1>Consulta de Peticiones</h1>
        <form id="consultaFormulario" onsubmit="return consultarEstado(event)">
            <label for="tipoConsulta">Selecciona tipo:</label>
            <select name="tipoConsulta" id="tipoConsulta">
                <option value="">-- Selecciona --</option>
                <option value="espacio">Espacio</option>
                <option value="insumo">Insumo</option>
            </select>
            <label for="idPeticion">Ingresa el ID de tu petición:</label>
            <input type="text" name="idPeticion" id="idPeticion" required>
            <button type="submit">Consultar</button>
        </form>
    </div>
    <div id="resultadoConsulta">
            <h3>Resultado de la consulta:</h3>
            <label for="resultadoId">ID de Petición:</label>
            <input type="text" id="resultadoId" readonly>
            <label for="resultadoEstado">Estado de la Petición:</label>
            <input type="text" id="resultadoEstado" readonly>
            <div id="infoAdicional"></div>
        </div>

    <script>
        async function consultarEstado(event) {
            event.preventDefault();

            const tipoConsulta = document.getElementById('tipoConsulta').value;
            const idPeticion = document.getElementById('idPeticion').value;

            if (!tipoConsulta || !idPeticion) {
                alert('Por favor, selecciona un tipo y proporciona un ID de petición.');
                return;
            }

            const url = tipoConsulta === 'espacio' ?
                'consultar_peticion_espacios.php' :
                'consultar_peticion_insumos.php';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `idPeticion=${idPeticion}`
                });

                const resultado = await response.json();

                const resultadoDiv = document.getElementById('resultadoConsulta');
                const resultadoId = document.getElementById('resultadoId');
                const resultadoEstado = document.getElementById('resultadoEstado');
                const infoAdicional = document.getElementById('infoAdicional');

                if (resultado.success) {
                    resultadoId.value = resultado.id;
                    resultadoEstado.value = resultado.estado_peticion || resultado.estado;

                    // Limpiar info adicional
                    infoAdicional.innerHTML = "";

                    if (tipoConsulta === 'insumo' && resultado.estado_peticion === 'Aprobada' && resultado.insumos && resultado.insumos.length > 0) {
                        // Mostrar tabla de insumos
                        let tabla = `<table style="width:100%;border-collapse:collapse;margin-top:10px;">
                    <tr>
                        <th style="border:1px solid #ccc;padding:5px;">Insumo</th>
                        <th style="border:1px solid #ccc;padding:5px;">Cantidad</th>
                    </tr>`;
                        resultado.insumos.forEach(insumo => {
                            tabla += `<tr>
                        <td style="border:1px solid #ccc;padding:5px;">${insumo.nombre}</td>
                        <td style="border:1px solid #ccc;padding:5px;">${insumo.cantidad}</td>
                    </tr>`;
                        });
                        tabla += `</table>`;
                        infoAdicional.innerHTML = `<label>Insumos asignados:</label>${tabla}`;
                    } else if (tipoConsulta === 'espacio' && resultado.estado_peticion === 'Aprobada' && resultado.espacio_asignado) {
                        // Mostrar espacio asignado
                        infoAdicional.innerHTML = `<label>Espacio asignado:</label>
                    <input type="text" value="${resultado.espacio_asignado}" readonly>`;
                    }
                } else {
                    resultadoId.value = "";
                    resultadoEstado.value = "";
                    infoAdicional.innerHTML = `<span style="color:red;">Error: ${resultado.message}</span>`;
                }

                resultadoDiv.style.display = 'block';
            } catch (error) {
                alert('Ocurrió un error al consultar el estado de la petición.');
                console.error(error);
            }
        }
    </script>
    <a class="regresar" href="peticiones_insumos.php">Volver atras</a>
</body>

</html>