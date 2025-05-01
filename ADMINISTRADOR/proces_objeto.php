<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta http-equiv="Refresh" content="1; url='agregarobjeto.php'" />
</head>
<body> </body>
</html>

<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Procesar el formulario para agregar un nuevo objeto de inventario
if (isset($_POST['agregar'])) {
    $nombre_objeto = $_POST['nombre'];
    $estado = "libre";
    $descripcion = $_POST['descripcion'];
    

    $sql = "INSERT INTO inventario (nom_inventario, estado, descripcion) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sss', $nombre_objeto, $estado, $descripcion);

    try {
        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'El objeto fue agregado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    timer: 3000,  // Durará 3 segundos
                    timerProgressBar: true  // Muestra una barra de progreso
                }).then((result) => {
                    window.location.href = 'agregarobjeto.php';
                });
            </script>";
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'El objeto ya existe en el inventario',
                    icon: 'error',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#d33',
                    timer: 2500,  // Durará 2.5 segundos
                    timerProgressBar: true
                }).then((result) => {
                    window.history.back();
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'Error al agregar el objeto: " . $e->getMessage() . "',
                    icon: 'error',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#d33',
                    timer: 2500,  // Durará 2.5 segundos
                    timerProgressBar: true
                });
            </script>";
        }
    }  
}
?>
