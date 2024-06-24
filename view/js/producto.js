var tabla;

function init() {
  mostrarFormulario(false);
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
  mostrarFormulario(false);
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
      url: "../ajax/producto.php?op=listar",
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

/**
 * Guardar o editar un producto.
 * 
 * @param {Event} e - El evento de envío del formulario.
 */
function guardarEditar(e) {
  e.preventDefault(); // Previene el comportamiento predeterminado del formulario.
  $("#btnGuardar").prop("disabled", true);

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
      $("#btnGuardar").prop("disabled", false);
      if (data == "ok") {
        // Muestra una notificación de éxito.
        toastr
          .success("El producto se ha guardado correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
        mostrarFormulario(false);
        tabla.ajax.reload();
      }else if (data == "okUpdated") {
        // Muestra una notificación de éxito.
        toastr
          .success("El producto se ha Actualizo correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
        mostrarFormulario(false);
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

/**
 * Muestra detalles de un producto según su ID.
 *
 * @param {number} id - El ID del producto a mostrar..
 */
function mostrar(id) {
  // Validar el ID
  if (id === undefined || id === null || typeof id !== "number") {
    console.error("Invalid id:", id);
    return;
  }

  // Envíe una solicitud POST al servidor para obtener los detalles del producto.
  $.post({
    url: "../ajax/producto.php?op=mostrar",
    data: { idProducto: id },
    success: function (response, status, jqXHR) {
      try {
        // Parsear la respuesta como JSON
        var data = JSON.parse(response);
      } catch (e) {
        // error al parsear la respuesta
        console.error("Failed to parse response:", e);
        return;
      }

      // Mostrar el formulario de edición
      mostrarFormulario(true);

      // Actualizar los campos del formulario con los detalles del producto
      $("#idProducto").val(data.prod_id); // Product ID
      $("#descripcion").val(data.prod_descripcion); // Product description
      $("#costo").val(data.prod_costo); // Product cost
      $("#unidadMedida").val(data.prod_um); // Product unit of measure
      $("#precio").val(data.prod_precio); // Product price
    },
    error: function (jqXHR, status, error) {
      // Error al obtener los detalles del producto
      console.error("Failed to fetch product data:", error);
    },
  });
}


document.addEventListener("DOMContentLoaded", function() {
  // Obtener la URL actual
  var currentUrl = window.location.pathname;

  // Verificar si la URL contiene 'producto.php'
  if (currentUrl.includes("producto.php")) {
    // Agregar clase 'active' al menú principal
    document.getElementById("menu-productos").classList.add("menu-open");
    document.getElementById("menu-productos").querySelector("a.nav-link").classList.add("active");

    // Agregar clase 'active' al submenú correspondiente
    document.getElementById("submenu-administrar-productos").classList.add("active");
  }

  // Contar los elementos de submenú
  var submenuList = document.getElementById("submenu-list");
  var submenuCount = submenuList.getElementsByClassName("nav-item").length;

  // Actualizar el contador en el span
  document.getElementById("submenu-count").textContent = submenuCount;
});




init();
