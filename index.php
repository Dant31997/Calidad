<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['rol']) && isset($_SESSION['estado'])) {
    // User is already logged in, redirect to appropriate dashboard
    if ($_SESSION['rol'] == "Funcionario") {
        header("Location: FUNCIONARIO/funcionario.php");
        exit();
    } elseif ($_SESSION['rol'] == "Administrador") {
        header("Location: ADMINISTRADOR/admin_panel.php");
        exit();
    } elseif ($_SESSION['rol'] == "Supervisor") {
        header("Location: SUPERVISOR/supervisor.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Iniciar Sesion</title>
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: "Poppins", Arial, sans-serif;
      }

      html,
      body {
        height: 100%;
        background: linear-gradient(135deg, #f5f7fa 0%, #d89785 100%);
      }

      body {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      .login-box {
        width: 360px;
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 40px 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .login-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
      }

      h2 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 28px;
        position: relative;
      }

      h2:after {
        content: "";
        display: block;
        width: 60px;
        height: 3px;
        background: #d91900;
        margin: 8px auto 0;
        border-radius: 3px;
      }

      .input-group {
        margin-bottom: 22px;
      }

      .input-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
        font-size: 14px;
      }

      .input-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.3s;
        font-size: 15px;
        background-color: #f9f9f9;
      }

      .input-group input:focus {
        outline: none;
        border-color: #d91900;
        box-shadow: 0 0 0 3px rgba(217, 25, 0, 0.1);
        background-color: #fff;
      }

      .login-button {
        width: 100%;
        padding: 12px;
        background-color: #d91900;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s;
        margin-top: 10px;
        box-shadow: 0 4px 6px rgba(217, 25, 0, 0.15);
      }

      .login-button:hover {
        background-color: #c61700;
        box-shadow: 0 6px 8px rgba(217, 25, 0, 0.2);
      }

      .login-button:active {
        transform: translateY(1px);
        box-shadow: 0 2px 4px rgba(217, 25, 0, 0.15);
      }

      @media (max-width: 480px) {
        .login-box {
          width: 100%;
          padding: 30px 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="login-box">
      <h2>Iniciar Sesion</h2>
      <form action="procesar_login.php" method="POST">
        <div class="input-group">
          <label for="nombre_usuario">Nombre de Usuario:</label>
          <input
            type="text"
            id="nombre_usuario"
            name="nombre_usuario"
            required
          /><br /><br />
        </div>
        <div class="input-group">
          <label for="contrasena">Contrasena:</label>
          <input
            type="password"
            id="contrasena"
            name="contrasena"
            required
          /><br /><br />
        </div>

        <input class="login-button" type="submit" value="Iniciar Sesion" />
      </form>
    </div>
  </body>
</html>
