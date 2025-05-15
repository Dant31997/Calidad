<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
    
</body>
</html>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $pide = isset($_POST['pide']) ? $conn->real_escape_string($_POST['pide']) : '';
    $nom_espacio = isset($_POST['nom_espacio']) ? $conn->real_escape_string($_POST['nom_espacio']) : '';
    $fecha_entrega = isset($_POST['fecha_entrega']) ? $conn->real_escape_string($_POST['fecha_entrega']) : '';
    $hora_entrega = isset($_POST['hora_entrega_espacio']) ? $conn->real_escape_string($_POST['hora_entrega_espacio']) : '';
    $hora_regreso = isset($_POST['hora_regreso_espacio']) ? $conn->real_escape_string($_POST['hora_regreso_espacio']) : '';

    // Validar que los campos no estén vacíos
    if (!empty($pide) && !empty($nom_espacio) && !empty($hora_entrega) && !empty($hora_regreso) && !empty($fecha_entrega)) {
        // Insertar los datos en la tabla peticiones_espacios
        $sql = "INSERT INTO peticiones_espacios (nom_espacio, pide, fecha_entrega, hora_entrega, hora_regreso) 
                VALUES ('$nom_espacio', '$pide', '$fecha_entrega', '$hora_entrega', '$hora_regreso')";

        if ($conn->query($sql) === TRUE) {
            // Obtener el ID de la petición generada
            $idPeticion = $conn->insert_id;
            echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Petición registrada exitosamente',
            html: 'El ID de tu petición es: <b>$idPeticion</b>',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = 'peticiones_insumos.php';
        });
    </script>";
        } else {
            echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error al registrar la petición',
            text: '" . addslashes($conn->error) . "',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = 'peticiones_insumos.php';
        });
    </script>";
        }
    } else {
        echo "
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor, completa todos los campos.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = 'peticiones_insumos.php';
        });
    </script>";
    }
}
// Cerrar la conexión
$conn->close();
