var tabla;

function init() {
  mostrarFormulario(false);
  listar();

  $("#formPersona").on("submit", function (e) {
    guardarEditar(e);
  });
}

function limpiar() {
  $("#idPersona").val("");
  $("#nombre").val("");
  $("#apellido").val("");
  $("#tipoDocumento").val("");
  $("#documento").val("");
}

function mostrarFormulario(x) {
  limpiar();

  if (x) {
    $("#listadoPersona").hide();
    $("#listado").hide();
    $("#formPersona").show();
    $("#btnGuardar").prop("disabled", false);
    $("#btnAgregar").hide();
  } else {
    $("#listadoPersona").show();
    $("#listado").show();
    $("#formPersona").hide();
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
      url: "../ajax/persona.php?op=listar",
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
  debugger;

  // Obtiene los valores de los campos del formulario.
  var nombre = $("#nombre").val();
  var apellido = $("#apellido").val();
  var tipoDocumento = $("#tipoDocumento").val();
  var documento = $("#documento").val();
  var idPersona = $("#idPersona").val();

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
    nombre: nombre,
    apellido: apellido,
    tipoDocumento: tipoDocumento,
    documento: documento,
    idPersona: idPersona,
  };

  // Envía una solicitud AJAX para guardar o editar el producto.
  $.ajax({
    url: "../ajax/persona.php?op=guardarEditar",
    type: "POST",
    data: formData,
    success: function (data) {
      debugger;
      $("#btnGuardar").prop("disabled", false);
      if (data == "ok") {
        // Muestra una notificación de éxito.
        toastr
          .success("La Persona se ha guardado correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
        mostrarFormulario(false);
        tabla.ajax.reload();
      }else if (data == "okUpdated") {
        // Muestra una notificación de éxito.
        toastr
          .success("La Persona se ha Actualizo correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
        mostrarFormulario(false);
        tabla.ajax.reload();
      } else {
        // Muestra una notificación de error.
        toastr
          .error("Hubo un problema al guardar la Persona.")
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
 * Muestra los detalles de una persona según su ID.
 *
 * @param {number} id - El ID de la persona a mostrar.
 */
function mostrar(id) {
  // Verifica si el ID es válido
  if (id === undefined || id === null || typeof id !== "number") {
    console.error("Invalid id:", id);
    return;
  }

  // Realiza una solicitud POST al servidor para obtener los detalles de la persona
  $.post({
    url: "../ajax/persona.php?op=mostrar",
    data: { idPersona: id }, // Envía el ID de la persona a obtener
    success: function (response, status, jqXHR) {
      try {
        // Parsea la respuesta como JSON
        var data = JSON.parse(response);
      } catch (e) {
        // Devuelve un console.error si no se pudo analizar la respuesta
        console.error("Error al obtener los datos:", e);
        return;
      }

      // Muestra el formulario con los detalles de la persona
      mostrarFormulario(true);

      // Asigna los valores a los inputs
      $("#idPersona").val(data.per_id); // ID de la persona
      $("#nombre").val(data.per_nombre); // Nombre de la persona
      $("#apellido").val(data.per_apellido); // Apellido de la persona
      $("#tipoDocumento").val(data.per_tipodocumento).change(); // Selecciona la opción correcta en el select
      $("#documento").val(data.per_documento); // Documento de la persona
    },
    error: function (jqXHR, status, error) {
      // Devuelve un console.error si no se pudo obtener la respuesta
      console.error("Error al obtener los datos:", error);
    },
  });
}

init();
