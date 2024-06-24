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
              <h1 class="m-0">FACTURAS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Facturas</li>
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
                    <button class="btn btn-success" id="btnAgregar" onclick="mostrarModalFacturaNew(true)">
                      <i class="fa fa-plus-circle"></i>
                      Agregar
                    </button>
                  </div>
                </div>
                <div class="card-body" id="listadoProducto">
                  <table id="tblListado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No. Factura</th>
                        <th>Nombre Completo</th>
                        <th>No. Articulos</th>
                        <th>Valor</th>
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
        </div>
      </section>
      <!-- /.content -->

      <!-- MODAL Factura-->
      <div class="modal fade" id="modal-factura">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Factura</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Factura -->
              <div class="container-fluid" id="facturaTotalDisplay">
                <div class="row" id="listado">
                  <div class="col-12" id="facturaImprimir">
                    <div class="invoice p-3 mb-3">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-12">
                          <h4 class="mb-0">
                            <img src="../public/dist/img/MagnetronLogo.png" alt="Magnetron Logo" class="brand-image img-fluid w-5" style="opacity: .8; max-height: 33px; margin-top: -3px;">
                            <span class="brand-text font-weight-light" style="color:rgb(23,78,134)">MAGNETRON</span>
                            <small class="float-right" style="text-align: right;">Factura No. <br><span id="idFactura">---FECHA---</span></small>
                          </h4>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <strong>MAGNETRON S.A.S</strong><br>
                            Tel: 3157100 Ext 186<br>
                            Km. 9 vía Pereira - Cartago.<br>
                            Pereira, Colombia<br>
                            www.magnetron.com.co
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Fecha:</b> <span id="fechaFactura">--IDFACTURA--</span>
                          <address>
                            <b>Nombre:</b> <strong id="nombre">----NOMBREA----</strong><br>
                            <b>Tipo de Documento:</b> <span id="tipoDocumento">--TIPDOC--</span><br>
                            <b>Documento:</b> <span id="documento">--DOCUMENTO--</span>
                          </address>
                        </div>

                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row" id="detallesFactura">
                        <div class="col-12 table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr style="text-align: center;">
                                <th>Id Prod</th>
                                <th>Descripcion</th>
                                <th>Unidad Medida</th>
                                <th>Precio</th>
                                <th>Linea</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody id="detalles" style="text-align: center;">
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <div class="col-6">
                          <p class="lead"></p>
                          <div class="table-responsive">
                            <table class="table">
                              <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td id="subtotal">--TOTAL--</td>
                              </tr>
                              <tr>
                                <th>Otros</th>
                                <td>$0</td>
                              </tr>
                              <tr>
                                <th>Total:</th>
                                <td id="total">--TOTAL--</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </div>
              <!-- /Factura -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="imprimirDiv('facturaImprimir')">
                <i class="fas fa-print"></i> Imprimir
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal-crear-factura" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="facturaModalLabel">Detalles de la Factura</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="facturaForm">
                <div class="mb-3">
                  <label for="cliente" class="form-label">Identificación de Persona</label>
                  <select class="form-control" id="idCliente" name="idCliente" required onclick="cargarClientes()">
                    <option value="">Seleccione un cliente</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="productos" class="form-label" id="label-productos">Detalle de lo Facturado</label>
                  <table class="table table-bordered" id="productosTable">
                    <thead>
                      <tr>
                        <th>Línea</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Unidad de Medida</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="productosBody">
                      <!-- Filas de productos se agregarán aquí dinámicamente -->
                    </tbody>
                  </table>
                  <button class="btn btn-success" id="btnAgregar" onclick="agregarProducto(true)">
                      <i class="fa fa-plus-circle"></i>
                      Agregar
                  </button>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" form="facturaForm">Guardar</button>
            </div>
          </div>
        </div>
      </div>


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