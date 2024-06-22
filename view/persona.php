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
              <h1 class="m-0">PERSONAS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">PERSONAS</li>
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
                <div class="card-body" id="listadoPersona">
                  <table id="tblListado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Tipo Documento</th>
                        <th>No. Documento</th>
                        <th>Acciones</th>
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

          <form class="form-horizontal" data-bitwarden-watching="1" id="formPersona" method="POST">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Persona</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nombre</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="nombre" placeholder="nombre">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Apellido</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="apellido" placeholder="apellido">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tipoDocumento" class="col-sm-3 col-form-label">Tipo Documento</label>
                  <div class="col-sm-9">
                    <select class="form-control custom-select" id="tipoDocumento">
                      <option value="" disabled selected>Seleccione un tipo de documento</option>
                      <option value="CC">CC</option>
                      <option value="NIT">NIT</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Documento</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="documento" placeholder="Unidad de Medida">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <input type="hidden" id="idPersona" value="0">
                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                <button class="btn btn-danger" onclick="cancelarFormulario()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              </div>
            </div>
          </form>
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