<!DOCTYPE html>
<html>
<head>
    <title>Supervisor</title>
    <style>
    body{
        font-family: Arial, sans-serif;
        margin-bottom: 15%;
        background-image: radial-gradient(circle at 62.28% 119.64%, #fe4700 0, #f83000 25%, #f10000 50%, #ea0003 75%, #e30007 100%);
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
            top: 80%; left: 43.5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .regresar:hover {
            background-color: #D62828;
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
            margin-left: 35%;
        }
        .custom-button:hover {
            background-color: #D62828;
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
            height: 260px;
            margin: 150px auto;
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
            background-color: #ff0000;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 30%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btno:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

</style>
</head>
<body>
<div class="login-box">
    <h2>Agregar Objeto al Inventario:</h2>
    <br>
    <form action="proces_objeto.php" method="post">
        <label for="nombre">Nombre del Objeto:</label>
        <input type="text" name="nombre" required>
        <br>
        <br>
        <label for="estado">Estado del Objeto:</label>
        <select name="estado">
            <option value="libre">Libre</option>
        </select>
        <br>
        <br>
        <br>
        <br>
        <input class="btno" type="submit" name="agregar" value="Agregar Objeto">
        <br>
    </form>
    </div>
    <a class ="regresar" href="http://localhost/proyecto/inventario/inventario.php">Volver al inventario</a>
</body>
</html>
