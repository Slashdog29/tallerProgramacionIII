<?php
    session_start();
    include "../conexion.php"; // 

    $nombre = $_SESSION['nombre'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $fyh = date('Y-m-d H:i:s');
    $acciones = "Cierre de Sesión";
    $sector = "Autenticación";

    $query_insert = mysqli_query($conexion, "INSERT INTO historial(usuario, ip, fyh, sector, acciones) VALUES ('$nombre', '$ip', '$fyh', '$sector', '$acciones')");
    
    session_destroy();
    header('location: ../');
?>
