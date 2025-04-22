<?php
// filepath: c:\xampp\htdocs\proyectofinal\procesar_peticion.php

// Configuración de la base de datos
$host = "localhost";
$dbname = "basededatos";
$username = "root";
$password = "";

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $equipo = $_POST['equipo'];
    $nombre = $_POST['nombre'];
    $horario_salida = $_POST['horario_salida'];
    $horario_devolucion = $_POST['horario_devolucion'];

    // Insertar los datos en la tabla peticiones_insumos
    $sql = "INSERT INTO peticiones_insumos (equipo, pide, horario_salida, horario_devolucion) 
            VALUES (:equipo, :nombre, :horario_salida, :horario_devolucion)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            ':equipo' => $equipo,
            ':nombre' => $nombre,
            ':horario_salida' => $horario_salida,
            ':horario_devolucion' => $horario_devolucion
        ]);
        echo "<script>alert('Petición registrada exitosamente.');
        window.location.href = 'peticiones_insumos.html';
        </script>";

    } catch (PDOException $e) {
        echo "Error al registrar la petición: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
?>