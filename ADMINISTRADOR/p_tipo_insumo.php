<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "basededatos");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Obtener y limpiar el dato del formulario
    $nombre_insumo = $conexion->real_escape_string($_POST['nombre_insumo']);

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO tipo_insumo (nombre_insumo) VALUES ('$nombre_insumo')";
?>
 <!DOCTYPE html>
    <html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    
    <?php
    if ($conexion->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'Tipo de insumo agregado correctamente',
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then((result) => {
                window.location.href = 'agregarobjeto.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Error al agregar el tipo de insumo: " . $conexion->error . "',
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then((result) => {
                window.location.href = 'agregarobjeto.php';
            });
        </script>";
    }
    $conexion->close();
}
?>
</body>
</html>