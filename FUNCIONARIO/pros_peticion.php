<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

if (isset($_POST['agregarpeticion'])) {
    $nombre = $_POST['nombre'];
    $equipo = $_POST['equipo'];
    ///$sonido = $_POST['sonido'];///
    $estado_peticion = "Sin Revisar";
    $dia_entrega = $_POST['dia_entrega'];
    $horario_prestamo = $_POST['horario_prestamo'];


    $sql = "INSERT INTO peticiones_insumos (equipo, pide, estado_peticion, dia_entrega, horario_prestamo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sssss', $equipo,  $nombre, $estado_peticion, $dia_entrega, $horario_prestamo);

    if ($stmt->execute()) {
        echo"<script>alert('peticion realizada');</script>";
    } else {
        echo "Error al agregar el objeto de inventario: " . $stmt->error;
    }
}
?>
<script>alert('peticion realizada');</script>
<script type="text/javascript">
history.back();
</script>
