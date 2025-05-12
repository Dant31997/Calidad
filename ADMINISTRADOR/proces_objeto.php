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
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Habilita excepciones

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Procesar el formulario para agregar un nuevo objeto de inventario
if (isset($_POST['agregar'])) {
    $nombre_objeto = $_POST['nombre'];
    $estado = "libre";
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    $nivel_insumo = null;
    $stmt_nivel = $conexion->prepare("SELECT nivel_insumo FROM tipo_insumo WHERE nombre_insumo = ?");
    $stmt_nivel->bind_param('s', $nombre_objeto);
    $stmt_nivel->execute();
    $stmt_nivel->bind_result($nivel_insumo);
    $stmt_nivel->fetch();
    $stmt_nivel->close();

    $sql = "INSERT INTO inventario (nivel_acceso, nom_inventario, estado, descripcion) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ssss', $nivel_insumo, $nombre_objeto, $estado, $descripcion);

    try {
        $insertados = 0;
        // Loop para insertar múltiples veces según la cantidad
        for ($i = 0; $i < $cantidad; $i++) {
            if ($stmt->execute()) {
                $insertados++;
            }
        }

        if ($insertados == $cantidad) {
            echo "<script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Se agregaron " . $cantidad . " objetos correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    timer: 3000,
                    timerProgressBar: true
                }).then((result) => {
                    window.location.href = 'agregarobjeto.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Parcialmente completado',
                    text: 'Se agregaron " . $insertados . " de " . $cantidad . " objetos',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    timer: 3000,
                    timerProgressBar: true
                }).then((result) => {
                    window.location.href = 'agregarobjeto.php';
                });
            </script>";
        }
        $stmt->close();
        $conexion->close();
        exit();
    } catch (mysqli_sql_exception $e) {
        $stmt->close();
        $conexion->close();
        if ($e->getCode() == 1062) {
            echo "<script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'El objeto ya existe en el inventario',
                    icon: 'error',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#d33',
                    timer: 2500,
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
                    timer: 2500,
                    timerProgressBar: true
                });
            </script>";
        }
    }
}
?>