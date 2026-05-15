</div>
</main>
</div>
<footer class="py-4 mt-auto" style="background-color: rgba(22, 27, 34, 0.8); backdrop-filter: blur(15px); border-top: 1px solid rgba(255, 255, 255, 0.1);">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small text-white-50">
            <div>Copyright &copy; Cyber Center 2024</div>
            <div class="d-flex align-items-center">
                <a href="#" class="text-decoration-none text-white-50 mx-2 hover-opacity">Política de Privacidad</a>
                <a href="#" class="text-decoration-none text-white-50 hover-opacity">Términos &amp; Condiciones</a>
            </div>
        </div>
    </div>
</footer>
<div id="nuevo_pass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Cambiar contraseña</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmPass">
                    <div class="form-group">
                        <label for="actual" class="small font-weight-bold">Contraseña Actual</label>
                        <input id="actual" class="form-control border-0 bg-light" type="password" name="actual" placeholder="Ingrese clave actual" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva" class="small font-weight-bold">Contraseña Nueva</label>
                        <input id="nueva" class="form-control border-0 bg-light" type="password" name="nueva" placeholder="Ingrese nueva clave" required>
                    </div>
                    <button class="btn btn-primary btn-block shadow-sm" type="button" onclick="btnCambiar(event)">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CERRAR SESIÓN (FIX) -->
<div id="logout_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-0">
                <h5 class="modal-title font-weight-bold text-dark">¿Cerrar Sesión?</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3 text-danger">
                    <i class="fas fa-sign-out-alt fa-3x"></i>
                </div>
                <p class="text-muted">¿Estás seguro de que deseas salir del sistema?</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <form action="salir.php" method="GET" class="w-100 d-flex justify-content-center">
                    <button type="button" class="btn btn-light mr-2 flex-grow-1" data-dismiss="modal">No, volver</button>
                    <a href="salir.php" class="btn btn-danger flex-grow-1">Sí, salir</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="../assets/js/Chart.bundle.min.js"></script>
<script src="../assets/js/funciones.js"></script>

<script>
    $(document).ready(function() {
        var path = window.location.pathname.split("/").pop();
        if (path == '') { path = 'index.php'; }
        
        $('.navbar-nav .nav-link').each(function() {
            var href = $(this).attr('href');
            if (path === href) {
                $(this).addClass('active');
            }
        });
    });
</script>
</body>
</html>