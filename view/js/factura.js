var tabla;

function init() {
  //mostrarFormulario(false);
  listar();

  $("#formProducto").on("submit", function (e) {
    guardarEditar(e);
  });
}

function limpiar() {
  $("#txtId").val("");
  $("#txtNombre").val("");
  $("#txtStock").val("");
  $("#txtPrecio").val("");
}

function mostrarFormulario(x) {
  limpiar();

  if (x) {
    $("#listadoProducto").hide();
    $("#listado").hide();
    $("#formProducto").show();
    $("#btnGuardar").prop("disabled", false);
    $("#btnAgregar").hide();
  } else {
    $("#listadoProducto").show();
    $("#listado").show();
    $("#formProducto").hide();
    $("#btnGuardar").prop("disabled", true);
    $("#btnAgregar").show();
  }
}

function cancelarFormulario() {
  limpiar();
  //mostrarFormulario(false);
}

// Function to open the modal and copy the content
function mostrarModal() {
  $('#modal-factura').modal('show');
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
      url: "../ajax/factura.php?op=listar",
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
    order: [[0, "asc"]],
    // Configuración de idioma
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
}

/**
 * Guardar o editar un producto.
 *
 * @param {Event} e - El evento de envío del formulario.
 */
function guardarEditar(e) {
  e.preventDefault(); // Previene el comportamiento predeterminado del formulario.
  $("#btnGuardar").prop("disabled", true);
  debugger;

  // Obtiene los valores de los campos del formulario.
  var descripcion = $("#descripcion").val();
  var precio = $("#precio").val();
  var costo = $("#costo").val();
  var unidadMedida = $("#unidadMedida").val();
  var idProducto = $("#idProducto").val();

  // Configuración de Toastr.
  toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };

  // Crea un objeto FormData para enviar los datos del formulario.
  var formData = {
    descripcion: descripcion,
    precio: precio,
    costo: costo,
    unidadMedida: unidadMedida,
    idProducto: idProducto,
  };

  // Envía una solicitud AJAX para guardar o editar el producto.
  $.ajax({
    url: "../ajax/producto.php?op=guardarEditar",
    type: "POST",
    data: formData,
    success: function (data) {
      debugger;
      $("#btnGuardar").prop("disabled", false);
      if (data == "ok") {
        // Muestra una notificación de éxito.
        toastr
          .success("El producto se ha guardado correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
        //mostrarFormulario(false);
        tabla.ajax.reload();
      } else if (data == "okUpdated") {
        // Muestra una notificación de éxito.
        toastr
          .success("El producto se ha Actualizo correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
        //mostrarFormulario(false);
        tabla.ajax.reload();
      } else {
        // Muestra una notificación de error.
        toastr
          .error("Hubo un problema al guardar el producto.")
          .css("background-color", "#dc3545")
          .css("color", "white");
      }
    },

    error: function (e) {
      console.log(e.responseText);
    },
  });

  limpiar();
}

function mostrar(id) {
  if (id === undefined || id === null || typeof id !== "number") {
    console.error("Invalid id:", id);
    return;
  }

  $.post({
    url: "../ajax/factura.php?op=mostrar",
    data: { iFactEncabezado: id },
    success: function (response, status, jqXHR) {
      debugger;
      try {
        var data = JSON.parse(response);
      } catch (e) {
        console.error("Failed to parse response:", e);
        return;
      }
      //mostrarFormulario(true);

      // Reemplazar los valores en el HTML de la factura
      document.getElementById('fechaFactura').textContent = data.fecha;
      document.getElementById('nombre').textContent = data.nombre;
      document.getElementById('tipoDocumento').textContent = data.tipoDocumento;
      document.getElementById('documento').textContent = data.documento;
      document.getElementById('idFactura').textContent = data.idFactura;
      document.getElementById('subtotal').textContent = data.total;
      document.getElementById('total').textContent = data.total;

      // Insertar los detalles de la factura
      const detallesContainer = document.getElementById('detalles');
      detallesContainer.innerHTML = ''; // Limpiar contenido previo

      if (data.detalles && Array.isArray(data.detalles)) {
        data.detalles.forEach(detalle => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${detalle.idProd}</td>
            <td>${detalle.descripcion}</td>
            <td>${detalle.unidadMedida}</td>
            <td style="text-align: right; padding-right: 3%;">${detalle.precio}</td>
            <td>${detalle.linea}</td>
            <td>${detalle.cantidad}</td>
            <td style="text-align: right; padding-right: 3%;">${detalle.total}</td>
          `;
          detallesContainer.appendChild(row);
        });
      } else {
        console.error("Detalles no encontrados o no es un array:", data.detalles);
      }
    },
    error: function (jqXHR, status, error) {
      console.error("Failed to fetch product data:", error);
    },
  });
}

function imprimirDiv(divId) {
  var contenido = document.getElementById(divId).innerHTML;
  var ventanaImpresion = window.open('', '', 'height=600,width=800');
  ventanaImpresion.document.write('<html><head><title>Factura-Venta-Magnetron</title>');
  ventanaImpresion.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
  ventanaImpresion.document.write('<style>@media print { body * { visibility: hidden; } .invoice, .invoice * { visibility: visible; } .invoice { position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; border: none; } }</style>');
  ventanaImpresion.document.write('</head><body>');
  ventanaImpresion.document.write(contenido);
  ventanaImpresion.document.write('</body></html>');
  ventanaImpresion.document.close();
  ventanaImpresion.focus();
  ventanaImpresion.print();
  ventanaImpresion.onafterprint = function() {
    ventanaImpresion.close();
  };
}

document.addEventListener("DOMContentLoaded", function () {
  // Obtener la URL actual
  var currentUrl = window.location.pathname;

  // Verificar si la URL contiene 'producto.php'
  if (currentUrl.includes("producto.php")) {
    // Agregar clase 'active' al menú principal
    document.getElementById("menu-productos").classList.add("menu-open");
    document
      .getElementById("menu-productos")
      .querySelector("a.nav-link")
      .classList.add("active");

    // Agregar clase 'active' al submenú correspondiente
    document
      .getElementById("submenu-administrar-productos")
      .classList.add("active");
  }

  // Contar los elementos de submenú
  var submenuList = document.getElementById("submenu-list");
  var submenuCount = submenuList.getElementsByClassName("nav-item").length;

  // Actualizar el contador en el span
  document.getElementById("submenu-count").textContent = submenuCount;
});

init();
