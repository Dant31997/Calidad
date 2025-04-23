<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto si tienes un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña configurada
$dbname = "basededatos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}   
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que los campos no estén vacíos
    if (!empty($_POST['equipo']) && !empty($_POST['nom_persona']) && !empty($_POST['hora_entrega']) && !empty($_POST['hora_regreso'])) {
        $equipo = $_POST['equipo'];
        $nombre = $_POST['nom_persona'];
        $horario_salida = $_POST['hora_entrega'];
        $horario_devolucion = $_POST['hora_regreso'];

        $sql = "INSERT INTO peticiones_insumos (equipo, nom_persona, hora_entrega, hora_regreso) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param("ssss", $equipo, $nombre, $horario_salida, $horario_devolucion);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "<script>alert('Petición registrada exitosamente.');
                window.location.href = 'peticiones_insumos.html';
                </script>";
            } else {
                echo "<script>alert('Error al registrar la petición: " . $stmt->error . "');
                window.location.href = 'peticiones_insumos.html';
                </script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Error en la preparación de la consulta: " . $conn->error . "');
            window.location.href = 'peticiones_insumos.html';
            </script>";
        }
    } else {
        // Si algún campo está vacío
        echo "<script>alert('Por favor, completa todos los campos.');
        window.location.href = 'peticiones_insumos.html';
        </script>";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>