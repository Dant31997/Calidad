<!DOCTYPE html>
<html>
<head>
    <title>Supervisor</title>
    <style>
        html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
    body{
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
            margin-top: 1%;
            margin-left: 33%;
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
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin-left: 60px;       
            border-collapse: collapse; 
        }

        th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
            border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

        td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
            color: #669;    border-top: 1px solid transparent; }

        tr:hover td { background: #d0dafd; color: #339; }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }

        .login-box {
            width: 400px;
            height: 280px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
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
            margin-top: 8%;
        }
        .btno:hover {
            background-color: #D62828;
        }

</style>
</head>
<body>
<div class="login-box">
    <h2>Agregar Espacio:</h2>
    <br>
    <form action="proces_espacio.php" method="post">
        <label for="nombre">Nombre del espacio:</label>
        <input type="text" name="nombre" required>
        <br>
        <br>
        <label for="estado">Estado del espacio:</label>
        <select name="estado">
            <option value="libre">Libre</option>
        </select>
        <br>
        <br>
        <input class="btno" type="submit" name="agregar" value="Agregar espacio">
        <br>
    </form>
    </div>
    <a class ="regresar" href="espacios.php">Volver a Espacios</a>
</body>
</html>