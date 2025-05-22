<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<?php
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que los campos no estén vacíos
    if (!empty($_POST['equipo']) && !empty($_POST['nom_persona']) && !empty($_POST['hora_entrega']) && !empty($_POST['hora_regreso'])) {
        $equipo = $_POST['equipo'];
        $nombre = $_POST['nom_persona'];
        $cantidad = $_POST['cantidad'];
        $fecha = date('Y-m-d');
        $horario_salida = $_POST['hora_entrega'];
        $horario_devolucion = $_POST['hora_regreso'];

        // Consulta preparada
        $sql = "INSERT INTO peticiones_insumos (equipo, cantidad, nom_persona, dia_entrega, hora_entrega, hora_regreso) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param("ssssss", $equipo, $cantidad, $nombre, $fecha, $horario_salida, $horario_devolucion);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Obtener el ID de la petición generada
                $idPeticion = $conexion->insert_id;
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Petición generada exitosamente!',
                        text: 'El ID de tu petición es: " . $idPeticion . "',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = 'peticiones_insumos.php';
                    });
                  </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al registrar la petición: " . $stmt->error . "',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = 'peticiones_insumos.php';
                    });
                  </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la preparación de la consulta: " . $conexion->error . "',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'peticiones_insumos.php';
                });
              </script>";
        }
    } else {
        // Si algún campo está vacío
        echo "<script>
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
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Método no válido',
            text: 'Método de solicitud no válido.',
            confirmButtonText: 'Aceptar'
        });
      </script>";
}
?>