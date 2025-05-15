<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cerrando sesión...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Sesión cerrada!',
        text: 'Adios, esperamos volver a verte pronto.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'index.php';
    });
</script>
</body>
</html>