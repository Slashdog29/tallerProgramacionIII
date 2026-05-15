<?php session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
    exit;
}
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Panel de Administración</title>
    
    <!-- Librerías Locales -->
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
    <script src="../assets/js/all.min.js"></script> <!-- Font Awesome icons -->
    <link rel="stylesheet" href="../assets/css/cyber-center.css">

    <style>
        /* FONDO GLOBAL DE LA PÁGINA */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('../assets/img/fondo.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Transiciones para ocultar suavemente */
        #layoutSidenav_nav, #layoutSidenav_content {
            transition: transform 0.3s ease-in-out, margin 0.3s ease-in-out, padding 0.3s ease-in-out !important;
        }

        /* AJUSTES DE DISEÑO DEL MENÚ */
        #sidenavAccordion {
            background-image: linear-gradient(rgba(22, 27, 34, 0.6), rgba(22, 27, 34, 0.6)), url('../assets/img/sidebar.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 5px 0 15px rgba(0,0,0,0.3);
        }

        .sb-sidenav-menu .nav-link {
            padding: 0.9rem 1.2rem !important;
            font-size: 0.88rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6) !important;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        /* EFECTO CUANDO LA PÁGINA ESTÁ ACTIVA */
        .sb-sidenav-menu .nav-link.active {
            color: #ffffff !important;
            background: rgba(79, 70, 229, 0.15) !important;
            border-left: 4px solid #4f46e5; 
        }

        .sb-sidenav-menu .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.05);
        }

        .sb-nav-link-icon {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1rem;
            transition: transform 0.3s;
        }

        .nav-link.active .sb-nav-link-icon {
            color: #818cf8 !important;
            transform: scale(1.1);
        }

        .sb-sidenav-menu-heading {
            padding: 1.5rem 1.2rem 0.5rem !important;
            font-size: 0.65rem !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255, 255, 255, 0.3);
        }

        /* Estilo Dropdown Superior */
        .user-name-tag {
            padding: 12px;
            background: #f8fafc;
            font-size: 0.75rem;
            font-weight: 800;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top" style="backdrop-filter: blur(10px); background-color: rgba(22, 27, 34, 0.95) !important;">
        <a class="navbar-brand font-weight-bold" href="index.php" style="letter-spacing: 1px;">CYBER<span class="text-primary">CENTER</span></a>
        
        <!-- Botón para móviles -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!-- Enlaces que antes estaban en la sidebar -->
            <ul class="navbar-nav mr-auto ml-lg-4">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="index.php">
                        <i class="fas fa-chart-line mr-1"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="clientes.php">
                        <i class="fas fa-users mr-1"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="usuarios.php">
                        <i class="fas fa-user-shield mr-1"></i> Usuarios
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow border-0" aria-labelledby="userDropdown" style="border-radius: 10px; overflow: hidden;">
                        <div class="user-name-tag text-primary text-uppercase"><?php echo $_SESSION['nombre']; ?></div>
                        <a class="dropdown-item py-2" href="#" data-toggle="modal" data-target="#nuevo_pass"><i class="fas fa-key mr-2 opacity-50"></i> Seguridad</a>
                        <div class="dropdown-divider m-0"></div> 
                        <a class="dropdown-item py-2 text-danger" href="#" data-toggle="modal" data-target="#logout_modal"><i class="fas fa-power-off mr-2"></i> Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor principal ajustado para el menú superior -->
    <div id="layoutMainContent" style="padding-top: 70px; flex: 1 0 auto;">
        <main>
            <div class="container-fluid px-4 py-4">
