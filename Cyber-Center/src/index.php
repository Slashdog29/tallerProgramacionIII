<?php 
include_once "includes/header.php";
require "../conexion.php";

// Datos de sesión y entorno
$nombre = $_SESSION['nombre'];
$ip     = $_SERVER['REMOTE_ADDR'];
$fyh    = date('Y-m-d H:i:s');
$sector = "Panel Principal";
$acciones = "Acceso al Dashboard";

// Registro en historial mediante prepared statement para seguridad
$stmtHist = $conexion->prepare("INSERT INTO HISTORIAL(usuario, ip, fyh, sector, acciones) VALUES (?, ?, ?, ?, ?)");
$stmtHist->bind_param("sssss", $nombre, $ip, $fyh, $sector, $acciones);
$stmtHist->execute();

// Conteos rápidos desde la base de datos real
$resU = mysqli_query($conexion, "SELECT COUNT(*) as total FROM USUARIO");
$totalU = mysqli_fetch_assoc($resU)['total'];

$resP = mysqli_query($conexion, "SELECT COUNT(*) as total FROM PERSONA");
$totalP = mysqli_fetch_assoc($resP)['total'];

$resE = mysqli_query($conexion, "SELECT COUNT(*) as total FROM EQUIPO");
$totalE = mysqli_fetch_assoc($resE)['total'];
?>

<style>
    :root {
        --primary: #4f46e5;
        --success: #10b981;
        --warning: #f59e0b;
        --bg-body: #f8fafc;
        --card-border: #f1f5f9;
    }

    .dashboard-container {
        padding: 1.5rem;
        animation: fadeIn 0.8s ease-out;
        background-color: transparent;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 1.5rem 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .page-header h1 {
        font-weight: 800;
        font-size: 1.5rem;
        color: #ffffff;
        letter-spacing: -0.5px;
        margin: 0;
    }
    
    .page-header p {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 1.8rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        display: block;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        transition: width 0.3s ease;
    }

    .card-primary::before { background: var(--primary); }
    .card-success::before { background: var(--success); }
    .card-warning::before { background: var(--warning); }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        border-color: #e2e8f0;
    }

    .stat-card:hover::before {
        width: 6px;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: #ffffff;
        margin: 0.5rem 0;
        line-height: 1;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        background-color: rgba(248, 250, 252, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.4);
    }
</style>

<div class="dashboard-container">
    <div class="page-header">
        <div>
            <h1>Panel de control de equipos</h1>
            <p class="text-muted small m-0">Bienvenido de nuevo, <strong><?php echo $nombre; ?></strong></p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge badge-light p-2 mr-3 text-muted"><i class="far fa-calendar-alt mr-1"></i> <?php echo date('d M, Y'); ?></span>
            <img src="../assets/img/images_800x800.png" class="rounded-circle shadow-sm" height="45" width="45" style="object-fit: cover; border: 2px solid white;">
        </div>
    </div>

    <div class="row">
        <!-- Usuarios del Sistema -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="usuarios.php" class="stat-card card-primary">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="stat-label">Administradores</span>
                        <div class="stat-value"><?php echo $totalU; ?></div>
                        <div class="text-primary small font-weight-bold">
                            <i class="fas fa-shield-alt mr-1"></i> Ver privilegios
                        </div>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Personas / Clientes -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="clientes.php" class="stat-card card-success">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="stat-label">Personas</span>
                        <div class="stat-value"><?php echo $totalP; ?></div>
                        <div class="text-success small font-weight-bold">
                            <i class="fas fa-id-card mr-1"></i> Registro activo
                        </div>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Equipos -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="config.php" class="stat-card card-warning">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="stat-label">Infraestructura</span>
                        <div class="stat-value"><?php echo $totalE; ?></div>
                        <div class="text-warning small font-weight-bold">
                            <i class="fas fa-desktop mr-1"></i> Equipos vinculados
                        </div>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="fas fa-laptop"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>