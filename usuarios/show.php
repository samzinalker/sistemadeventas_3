<?php
include('../app/config.php');
include('../layout/sesion.php'); // Incluir layout/sesion.php para definir $nombres_sesion
include('../layout/permisos.php'); // Validar permisos de administrador


// Validar si la sesión está activa
if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['rol'])) {
    $_SESSION['mensaje'] = "Debes iniciar sesión para acceder a esta página.";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/login');
    exit();
}

// Validar el rol del usuario (solo administradores pueden ver esta página)
if ($_SESSION['rol'] !== 'administrador') {
    $_SESSION['mensaje'] = "No tienes permisos para acceder a esta página.";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/index.php');
    exit();
}

include('../layout/parte1.php');
include('../app/controllers/usuarios/show_usuario.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Datos del usuario</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombres</label>
                                        <input type="text" name="nombres" class="form-control" value="<?php echo $nombres; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Rol del usuario</label>
                                        <input type="text" name="rol" class="form-control" value="<?php echo $rol; ?>" disabled>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-secondary">Volver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>