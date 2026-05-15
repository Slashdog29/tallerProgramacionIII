<?php
    session_start();
    include "../conexion.php"; // <--- AGREGA ESTA LÍNEA (Verifica que la ruta sea correcta)

    $nombre = $_SESSION['nombre'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $fyh = date('Y-m-d H:i:s');
    $acciones = "Cierre de Sesión";

    // Ahora $conexion ya tendrá valor y no dará Fatal Error
    $query_insert = mysqli_query($conexion, "INSERT INTO HISTORIAL(usuario, ip, fyh, sector, acciones) VALUES ('$nombre', '$ip', '$fyh', '$ip', '$acciones')");
    
    session_destroy();
    header('location: ../');
?>
