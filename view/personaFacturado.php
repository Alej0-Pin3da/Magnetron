<!DOCTYPE html>
<html lang="en">
<?php require_once "header.php"; ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="../public/dist/img/MagnetronLogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include_once "nav.php"; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once "menu.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Cantidad Facturada Por Persona</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row" id="listado">
            <div class="col-12">
              <div class="card">
                <div class="card-body" id="listadoProducto">
                  <table id="tblListado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id Persona</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Total facturado</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <!-- /.box-body -->
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <!-- Main Footer -->
    <?php include_once "footer.php"; ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>