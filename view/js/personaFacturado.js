var tabla;

function init() {
  listar();
}

/**
 * Initializes the DataTable with the necessary configurations.
 *
 * @return {void}
 */
function listar() {
  // Inicializar DataTable
  tabla = $("#tblListado").DataTable({
    // Indica que los datos se van a procesar en segundo plano
    aProcessing: true,
    // La recuperación de datos se realiza en el lado del servidor.
    aServerSide: true,
    // Agregar botones para exportar datos y que botones se van a mostrar
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],

    // Configuración AJAX para recuperación de datos
    ajax: {
      url: "../ajax/personaFacturado.php?op=listar",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    // Limpiar la tabla existente si existe
    bDestroy: true,
    // Número de registros a mostrar por página
    iDisplayLength: 5,
    // Ordena los datos en orden ascendente por la primera columna.
    order: [[2, "desc"]],
    // Configuración de idioma
    language: {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}

init();
