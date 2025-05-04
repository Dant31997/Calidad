<?php
// filepath: c:\xampp\htdocs\proyectofinal\ADMINISTRADOR\verificar_insumos.php

// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "basededatos";

// Conexión a la base de datos
$conexion = new mysqli($host, $user, $password, $database);

// Verifica si la conexión fue exitosa
if ($conexion->connect_error) {
    die(json_encode([
        "success" => false,
        "message" => "Error en la conexión a la base de datos: " . $conexion->connect_error
    ]));
}

// Obtiene los datos enviados desde el cliente
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que los datos necesarios estén presentes
if (!isset($data['inventario']) || !isset($data['cantidad'])) {
    echo json_encode([
        "success" => false,
        "message" => "Datos incompletos. Se requiere 'inventario' y 'cantidad'."
    ]);
    exit;
}

$inventario = $conexion->real_escape_string($data['nom_inventario']);
$cantidad = (int)$data['cantidad'];

// Consulta para verificar la cantidad de insumos disponibles
$sql = "SELECT COUNT(*) AS disponibles 
        FROM inventario 
        WHERE nom_inventario = '$inventario' AND estado = 'Libre'";

$resultado = $conexion->query($sql);

// Verifica si la consulta fue exitosa
if ($resultado) {
    $fila = $resultado->fetch_assoc();
    $disponibles = (int)$fila['disponibles'];

    // Compara la cantidad solicitada con la cantidad disponible
    if ($cantidad <= $disponibles) {
        echo json_encode([
            "success" => true,
            "suficiente" => true,
            "message" => "Hay suficientes insumos disponibles."
        ]);
    } else {
        echo json_encode([
            "success" => true,
            "suficiente" => false,
            "message" => "No hay suficientes insumos disponibles."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Error al realizar la consulta: " . $conexion->error
    ]);
}

// Cierra la conexión a la base de datos
$conexion->close();
?>