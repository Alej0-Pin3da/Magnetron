var tabla;

/**
 * Inicializa la aplicación realizando los siguientes pasos:
 * - Oculta la etiqueta y tabla de productos.
 * - Adjunta un detector de eventos de envío al elemento facturaForm, que llama a la función guardarEditar.
 *
 * @return {void} .
 */
function init() {
  listar();
  $("#label-productos").hide();
  $("#productosTable").hide();

  $("#facturaForm").on("submit", function (e) {
    guardarEditar(e);
  });
}


/**
 * Borra el formulario restableciendo todos sus campos.
 *
 * @return {void} This function does not return anything.
 */
function limpiar() {
  // Obtener el elemento del formulario por su ID
  var formulario = document.getElementById("facturaForm");

  // Restablecer el formulario, borrando todos sus campos
  formulario.reset();
}

/**
 * Muestra el modal de facturas.
 *
 * @return {void} .
 */
function mostrarModalFacturaImp() {
  $('#modal-factura').modal('show');
}


/**
 * Muestra el modal de para crear facturas.
 *
 * @return {void} This function does not return anything.
 */
function mostrarModalFacturaNew() {
  $('#modal-crear-factura').modal('show');
}

/**
 * Oculta el modal de para crear facturas.
 *
 * @return {void} This function does not return anything.
 */
function ocultarModalFacturaNew() {
  $('#modal-crear-factura').modal('hide');
}


/**
 * Recarga la tabla de facturas.
 * @return {void} This function does not return anything.
 */
function recargarTabla() {
  if (tabla) {
      tabla.ajax.reload(null, false); // false para mantener la página actual
  } else {
      console.error('La tabla no está inicializada.');
  }
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
    // Configuración de idioma para mosrtar en español
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
  var idCliente = $("#idCliente").val();

  // Obtiene los valores de los productos agregados dinámicamente.
  var productos = [];
  $("#productosBody tr").each(function() {
    var cantidad = $(this).find("input[name='cantidad[]']").val();
    var idProducto = $(this).find("select[name='producto[]']").val();
    var linea = $(this).find("select[name='linea[]']").val();

    productos.push({
      cantidad: cantidad,
      idProducto: idProducto,
      linea: linea
    });
  });

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
    idCliente: idCliente,
    linea: linea,
    productos: productos
  };

  // Envía una solicitud AJAX para guardar o editar la factura.
  $.ajax({
    url: "../ajax/factura.php?op=guardarEditar",
    type: "POST",
    data: JSON.stringify(formData),
    contentType: "application/json",
    success: function (data) {
      debugger;
      $("#btnGuardar").prop("disabled", false);
      if (data == "ok") {
        // Muestra una notificación de éxito.
        toastr
          .success("La Persona se ha guardado correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
          ocultarModalFacturaNew();
          recargarTabla();
      } else if (data == "okUpdated") {
        // Muestra una notificación de éxito.
        toastr
          .success("La Persona se ha Actualizo correctamente.")
          .css("background-color", "#28a745")
          .css("color", "white");
          ocultarModalFacturaNew();
          recargarTabla();
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
 * Obtiene y muestra los detalles de una factura basandose en el ID.
 *
 * @param {number} idFactura - The id of the factura to display.
 * @returns {void}
 */
function mostrar(idFactura) {
  // Validar el id de la factura
  if (idFactura === undefined || idFactura === null || typeof idFactura !== "number") {
    console.error("Id de la Factura no es valido:", idFactura);
    return;
  }

  // Realice una solicitud POST al servidor para obtener los detalles de la factura.
  $.post({
    url: "../ajax/factura.php?op=mostrar",
    data: { iFactEncabezado: idFactura },
    success: function (response, status, jqXHR) {
      try {
        // Parsea la respuesta como JSON
        var data = JSON.parse(response);
      } catch (e) {
        // Devuelve un console.error si no se pudo analizar la respuesta
        console.error("Failed to parse response:", e);
        return;
      }

      // Actualiza el HTML con los detalles de la factura.
      document.getElementById('fechaFactura').textContent = data.fecha;
      document.getElementById('nombre').textContent = data.nombre;
      document.getElementById('tipoDocumento').textContent = data.tipoDocumento;
      document.getElementById('documento').textContent = data.documento;
      document.getElementById('idFactura').textContent = data.idFactura;
      document.getElementById('subtotal').textContent = data.total;
      document.getElementById('total').textContent = data.total;

      // Inserta los detalles de la factura en el HTML.
      const detallesContainer = document.getElementById('detalles');
      detallesContainer.innerHTML = ''; // Borrar contenido anterior

      if (data.detalles && Array.isArray(data.detalles)) {
        // Itera sobre los detalles de los productos y cree una fila de tabla para cada uno
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
        // Devuelve un console.error si no se encontró o no era un array
        console.error("Detalles no encontrados o no es un array:", data.detalles);
      }
    },
    error: function (jqXHR, status, error) {
      // Devuelve un console.error si no se pudo obtener la respuesta
      console.error("No se pudieron recuperar los datos del producto:", error);
    },
  });
}

/**
 * Imprime el contenido de un elemento HTML en una nueva ventana.
 * 
 * @param {string} divId - El ID del elemento HTML que se desea imprimir.
 */
function imprimirDiv(divId) {
  // Obtiene el contenido del elemento HTML especificado.
  var contenido = document.getElementById(divId).innerHTML;

  // Abre una nueva ventana con tamaño especificado.
  var ventanaImpresion = window.open('', '', 'height=600,width=800');

  // Escribe el contenido en la ventana de impresión.
  ventanaImpresion.document.write('<html><head><title>Factura-Venta-Magnetron</title>');
  ventanaImpresion.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
  ventanaImpresion.document.write('<style>@media print { body * { visibility: hidden; } .invoice, .invoice * { visibility: visible; } .invoice { position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; border: none; } }</style>');
  ventanaImpresion.document.write('</head><body>');
  ventanaImpresion.document.write(contenido);
  ventanaImpresion.document.write('</body></html>');
  ventanaImpresion.document.close();

  // Fija el foco en la ventana de impresión y realiza la impresión.
  ventanaImpresion.focus();
  ventanaImpresion.print();

  // Cierra la ventana de impresión después de imprimir.
  ventanaImpresion.onafterprint = function() {
    ventanaImpresion.close();
  };
}

/**
 * Elimina una fila de productos de la tabla y actualiza los números de línea.
 *
 * @param {HTMLElement} button
 */
function eliminarProducto(button) {
  // Se obtiene la fila principal del botón
  const row = button.parentNode.parentNode;

  // Elimina la final de la tabla
  row.remove();

  // Actualiza los índices de las filas
  actualizarNumeroProducto();
}

/**
 * Actualiza los números de línea de las filas de productos en la tabla.
 * Los números de línea se actualizan en base a la posición de la fila en la tabla.
 */
function actualizarNumeroProducto() {
  // Obtener todas las filas en el cuerpo de la tabla de productos
  const filas = document.querySelectorAll('#productosBody tr');

  // Iterar sobre cada fila y actualizar el número de línea
  filas.forEach((fila, index) => {
    // Actualizar el texto del primer elemento de la fila (contiene el número de línea)
    fila.children[0].textContent = index + 1; // Índice de la fila + 1, ya que los índices comienzan en 0
  });
}

/**
 * Carga las opciones de selección de clientes en el elemento HTML con el id 'idCliente'
 *
 * Primero, verifica si el elemento ya tiene opciones. Si lo tiene, no realiza ninguna acción.
 * Si no tiene opciones, realiza una solicitud AJAX a la URL '../ajax/factura.php?op=listarClientes'
 * para obtener los datos de los clientes y agregar las opciones correspondientes al elemento.
 *
 * @returns {void}
 */
function cargarClientes() {
  var clienteSelect = document.getElementById('idCliente');
  // Verificar si el select ya tiene opciones además de la opción por defecto
  if (clienteSelect.length > 1) {
    return; // Si ya tiene opciones, no hacer nada
  }

  // Realizar una solicitud AJAX para obtener los datos de los clientes
  $.ajax({
    url: '../ajax/factura.php?op=listarClientes',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      // Crear las opciones correspondientes a cada cliente
      data.forEach(function(cliente) {
        var option = document.createElement('option');
        option.value = cliente.per_id;
        option.textContent = cliente.per_nombre + ' ' + cliente.per_apellido + ' - ' + cliente.per_tipodocumento + ' ' + cliente.per_documento;
        clienteSelect.appendChild(option);
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Error al cargar los clientes:', textStatus, errorThrown);
    }
  });
}

/**
 * Carga las opciones de selección de productos en el elemento HTML con el id 'idProducto'
 *
 * Primero, realiza una solicitud AJAX a la URL '../ajax/factura.php?op=listarProductos'
 * para obtener los datos de los productos y agregar las opciones correspondientes al elemento.
 *
 * @param {HTMLElement} selectElement - El elemento select en el que se cargarán las opciones
 * @returns {void}
 */
function cargarProducto(selectElement) {
  // Realizar una solicitud AJAX para obtener los datos de los productos
  $.ajax({
    url: '../ajax/factura.php?op=listarProductos',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      // Crear las opciones correspondientes a cada producto
      data.forEach(function(producto) {
        var option = document.createElement('option'); // Crear una nueva opción
        option.value = producto.prod_id; // Establecer el valor de la opción
        option.textContent = producto.prod_descripcion; // Establecer el texto de la opción
        option.dataset.unidadMedida = producto.prod_um; // Almacenar la unidad de medida en los atributos de datos
        option.dataset.precio = producto.prod_precio; // Almacenar el precio en los atributos de datos
        selectElement.appendChild(option); // Agregar la opción al elemento select
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Error al cargar los productos:', textStatus, errorThrown);
    }
  });
}

/**
 * Agrega una nueva fila a la tabla de productos con los campos necesarios.
 *
 * @returns {void}
 */
function agregarProducto() {
  // Mostrar la etiqueta y la tabla de productos
  $("#label-productos").show();
  $("#productosTable").show();

  // Obtener el cuerpo de la tabla de productos
  const productosBody = document.getElementById('productosBody');
  if (!productosBody) {
    console.error('productosBody no existe');
    return;
  }

  // Crear una nueva fila para el producto
  const linea = productosBody.children.length + 1;
  const row = document.createElement('tr');

  // Establecer el contenido de la fila
  row.innerHTML = `
    <td>${linea}</td>
    <td>
      <select class="form-control" id="linea" name="linea[]" required onclick="cargarClientes()">
        <option value="" disabled selected>Seleccione una linea</option>
        <option value="normal">Normal</option>
        <option value="premium">Premium</option>
      </select>
    </td>
    <td><input type="number" class="form-control" name="cantidad[]" id="cantidad" required></td>
    <td>
      <select class="form-control" id="producto" name="producto[]" required onchange="cargarDatosProducto(this)">
        <option value="">Seleccione un producto</option>
      </select>
    </td>
    <td><input type="text" class="form-control" name="unidadMedida[]" id="unidadMedida" required disabled></td>
    <td><input type="number" class="form-control" name="precio[]" id="precio" required disabled></td>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(this)">Eliminar</button></td>
  `;

  // Agregar la nueva fila a la tabla de productos
  productosBody.appendChild(row);

  // Obtener el elemento select del producto y cargar los datos
  const selectElement = row.querySelector('select[name="producto[]"]');
  if (selectElement) {
    cargarProducto(selectElement);
  } else {
    console.error('selectElement no encontrado');
  }
}

/**
 * Carga las opciones de selección de productos en el elemento selectElement.
 * @param {HTMLElement} selectElement - El elemento select en el que se cargarán las opciones
 */
function cargarProducto(selectElement) {
  // Realizar una solicitud AJAX para obtener los datos de los productos
  $.ajax({
    url: '../ajax/factura.php?op=listarProductos',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      // Crear las opciones correspondientes a cada producto
      data.forEach(function(producto) {
        var option = document.createElement('option');
        option.value = producto.prod_id;
        option.textContent = producto.prod_descripcion;
        option.dataset.unidadMedida = producto.prod_um;
        option.dataset.precio = producto.prod_precio;
        // Agregar la opción al elemento select
        if (selectElement) {
          selectElement.appendChild(option);
        } else {
          // Mostrar un error si selectElement es undefined
          console.error('selectElement es undefined');
        }
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Mostrar un error si ocurre un error al cargar los productos
      console.error('Error al cargar los productos:', textStatus, errorThrown);
    }
  });
}

/**
 * Carga los datos del producto seleccionado en los campos correspondientes.
 * @param {HTMLElement} selectElement - El elemento select del producto seleccionado.
 */
function cargarDatosProducto(selectElement) {
  // Obtener la opción seleccionada y sus datos
  const selectedOption = selectElement.options[selectElement.selectedIndex];
  const unidadMedida = selectedOption.dataset.unidadMedida;
  const precio = selectedOption.dataset.precio;

  // Obtener la fila de la tabla y los campos correspondientes
  const row = selectElement.closest('tr'); // Obtiene el elemento tr más cercano al select
  const unidadMedidaInput = row.querySelector('input[name="unidadMedida[]"]'); // Obtiene el input de la unidad de medida
  const precioInput = row.querySelector('input[name="precio[]"]'); // Obtiene el input del precio

  // Asignar los valores a los campos correspondientes
  unidadMedidaInput.value = unidadMedida;
  precioInput.value = precio;
}

// Llamar a la función init() para iniciar el código
init();