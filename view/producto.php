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
              <h1 class="m-0">PRODUCTOS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">PRODUCTOS</li>
              </ol>
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
                <div class="card-header">
                  <div class="box-header">
                    <button class="btn btn-success" id="btnAgregar" onclick="mostrarFormulario(true)">
                      <i class="fa fa-plus-circle"></i>
                      Agregar
                    </button>
                  </div>
                </div>
                <div class="card-body" id="listadoProducto">
                  <table id="tblListado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Costo</th>
                        <th>Unidad de Medida</th>
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
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Horizontal Form</h3>
            </div>

            <form class="form-horizontal" data-bitwarden-watching="1" id="formProducto" method="POST">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Descripcion</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="descripcion" placeholder="Descripcion">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Precio</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="precio" placeholder="Precio">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Costo</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="costo" placeholder="Costo">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Unidad de Medida</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="unidadMedida" placeholder="Unidad de Medida">
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <input type="hidden" id="idProducto" value="0">
                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                <button class="btn btn-danger" onclick="cancelarFormulario()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              </div>
            </form>

          </div>

      </section>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include_once "footer.php"; ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>