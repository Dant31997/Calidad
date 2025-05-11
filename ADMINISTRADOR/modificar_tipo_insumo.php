<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Modificar Tipo de Insumo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 450px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #D62828;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D62828;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #943126;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>MODIFICAR TIPO DE INSUMO</h2>

        <?php
        $id_insumo = $_GET['id_insumo'];
        $nivel_insumo = $_GET['nivel_insumo'];
        $nombre_insumo = $_GET['nombre_insumo'];
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "basededatos");

        // Verificar conexión
        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }
        

        ?>
        <form method="post" action="gestionar_tipo_insumo.php">
            <input type="hidden" name="id_insumo" value="<?php echo $id_insumo; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre_insumo); ?>" required>
            </div>

            <div class="form-group">
                <label for="nivel_acceso">Nivel de acceso:</label>
                <select id="nivel_acceso" name="nivel_acceso">
                    <option value="1" <?php echo ($nivel_insumo == '1' ? 'selected' : ''); ?>>Nivel 1</option>
                    <option value="2" <?php echo ($nivel_insumo == '2' ? 'selected' : ''); ?>>Nivel 2</option>
                    <option value="3" <?php echo ($nivel_insumo == '3' ? 'selected' : ''); ?>>Nivel 3</option>
                </select>
            </div>

            <div class="buttons">
                <button style="background: green;" type="submit" name="actualizar" class="btn">Guardar cambios</button>
                <a href="gestionar_tipo_insumo.php" class="btn">Cancelar</a>
                
            </div>
        </form>

        <?php


        $conexion->close();
        ?>
    </div>
</body>

</html>