<html>  
    <script>
        function abrirModal() {
            document.getElementById("miModal").style.display = "block";

            // Cierra el modal después de 5 segundos (5000 milisegundos)
            setTimeout(function() {
                cerrarModal();
            }, 5000); // 5000 milisegundos = 5 segundos
        }

        function cerrarModal() {
            document.getElementById("miModal").style.display = "none";
        }

        // Cierra el modal si el usuario hace clic fuera del contenido
        window.onclick = function(event) {
            var modal = document.getElementById("miModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <div id="miModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <p>¡Este es el texto dentro del modal!</p>
    </div>
    </div>

<style>
    /* Estilos del fondo del modal */
    .modal {
      display: none; 
      position: fixed; 
      z-index: 1; 
      left: 0;
      top: 0;
      width: 100%; 
      height: 100%; 
      overflow: auto; 
      background-color: rgba(0, 0, 0, 0.5); 
    }

    /* Contenido del modal */
    .modal-content {
      background-color: #fff;
      margin: 15% auto; 
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 400px;
      text-align: center;
    }

    /* Botón para cerrar */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }
    .close:hover {
      color: #000;
    }
</style>
</html>
<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}



// Obtiene los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];
$ciudad = $_POST['ciudad'];

try{
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, nombre, rol, ciudad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $nombre_usuario, $contrasena, $nombre, $rol, $ciudad);
    
    
    if ($stmt->execute()) {
        echo"<script>abrirModal();</script>";
    } else {
        echo"No se puede crear este usuario";
    }
    $stmt->close();
    $conexion->close();

} catch (mysqli_sql_exception $e) {
    // Manejo de la excepción 
    echo"<script>alert('Nombre de usuario ya usado, vuelva a intentar.');</script>". $e->getMessage() ."";
}
?>
<meta http-equiv="Refresh" content="0; url='admin_panel.php'" />