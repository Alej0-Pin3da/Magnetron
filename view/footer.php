<footer class="main-footer">
    <strong>Copyright &copy; 2024 Magnetron.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
</footer>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../public/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../public/plugins/raphael/raphael.min.js"></script>
<script src="../public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../public/plugins/chart.js/Chart.min.js"></script>

<!-- DataTables -->
<script src="../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../public/plugins/jszip/jszip.min.js"></script>
<script src="../public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Toastr -->
<script src="../public/plugins/toastr/toastr.min.js"></script>

<!-- Funciones JS Producto -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
  // Obtener la URL actual
  var currentUrl = window.location.pathname;

  // Función para cargar un script
  function loadScript(url) {
    var script = document.createElement('script');
    script.src = url;
    document.head.appendChild(script);
  }

  // Cargar el script correspondiente según la URL
  if (currentUrl.includes('/view/producto.php')) {
    loadScript('../view/js/producto.js');
  } else if (currentUrl.includes('/view/productoCantidad.php')) {
    loadScript('../view/js/productoCantidad.js');
  } else if (currentUrl.includes('/view/productoUtilidad.php')) {
    console.log('Utilidad');    loadScript('../view/js/productoUtilidad.js');
  } else if (currentUrl.includes('/view/productoGanancia.php')) {
    loadScript('../view/js/productoGanancia.js');
  } else if (currentUrl.includes('/view/persona.php')) {
    loadScript('../view/js/persona.js');
  } else if (currentUrl.includes('/view/personaFacturado.php')) {
    loadScript('../view/js/personaFacturado.js');
  } else if (currentUrl.includes('/view/personaProdMasCaro.php')) {
    loadScript('../view/js/personaProdMasCaro.js');
  } else if (currentUrl.includes('/view/')) {
    loadScript('../view/js/factura.js');
  }
});

</script>