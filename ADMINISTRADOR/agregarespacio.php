<!DOCTYPE html>
<html>

<head>
    <title>Supervisor</title>
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

        .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute; top: 85%; left: 45%;
        }

        .regresar:hover {
            background-color: #D62828;
        }

        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0074D9;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 35%;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin-left: 60px;
            border-collapse: collapse;
        }

        th {
            font-size: 13px;
            font-weight: normal;
            padding: 8px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: #039;
        }

        td {
            padding: 8px;
            background: #e8edff;
            border-bottom: 1px solid #fff;
            color: #669;
            border-top: 1px solid transparent;
        }

        tr:hover td {
            background: #d0dafd;
            color: #339;
        }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }

        .login-box {
            position: absolute;
            top: 5%;
            left: 35%;
            width: 400px;
            height: 410px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .btno {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 30%;
            margin-top: 2%;
        }

        .btno:hover {
            background-color: #D62828;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            font-family: Arial, sans-serif;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus {
            border-color: #0074D9;
            box-shadow: 0 0 5px rgba(0, 116, 217, 0.5);
            outline: none;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Agregar Espacio</h2>
        <br>
        <form action="proces_espacio.php" method="post">
            <label for="nombre">Nombre del espacio:</label>
            <input type="text" name="nombre" class="form-input" required>
            <br>
            <label for="Descripcion">Descripción:</label>
            <textarea name="Descripcion" rows="4" cols="40" class="form-input" required></textarea>
            <br>
            <label for="capacidad">Capacidad:</label>
            <input type="text" name="capacidad" class="form-input" required>
            <br>
            <input type="hidden" name="estado" value="libre">
            <input class="btno" type="submit" name="agregar" value="Agregar espacio">
            <br>
        </form>
    </div>
    <a class="regresar" href="espacios.php">Volver a Espacios</a>
</body>

</html>