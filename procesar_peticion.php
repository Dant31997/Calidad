<?php
// filepath: c:\xampp\htdocs\proyectofinal\procesar_peticion_espacios.php
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$pide = $_POST['pide'];
$nom_espacio = $_POST['nom_espacio'];
$fecha_entrega = $_POST['fecha_entrega'];
$hora_entrega_espacio = $_POST['hora_entrega_espacio'];
$hora_regreso_espacio = $_POST['hora_regreso_espacio'];
  
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que los campos no estén vacíos
    if (!empty($_POST['equipo']) && !empty($_POST['nom_persona']) && !empty($_POST['hora_entrega']) && !empty($_POST['hora_regreso'])) {
        $equipo = $_POST['equipo'];
        $nombre = $_POST['nom_persona'];
        $horario_salida = $_POST['hora_entrega'];
        $horario_devolucion = $_POST['hora_regreso'];

        // Consulta preparada
        $sql = "INSERT INTO peticiones_insumos (equipo, nom_persona, hora_entrega, hora_regreso) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param("ssss", $equipo, $nombre, $horario_salida, $horario_devolucion);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Obtener el ID de la petición generada
                $idPeticion = $conexion->insert_id;
                echo "<script>
                    alert('Petición generada exitosamente. El ID de tu petición es: " . $idPeticion . "');
                    window.location.href = 'peticiones_insumos.html';
                  </script>";
            } else {
                echo "<script>
                    alert('Error al registrar la petición: " . $stmt->error . "');
                    window.location.href = 'peticiones_insumos.html';
                  </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                alert('Error en la preparación de la consulta: " . $conexion->error . "');
                window.location.href = 'peticiones_insumos.html';
              </script>";
        }
    } else {
        // Si algún campo está vacío
        echo "<script>
            alert('Por favor, completa todos los campos.');
            window.location.href = 'peticiones_insumos.html';
          </script>";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>