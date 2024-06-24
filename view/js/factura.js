var tabla;

function init() {
  //mostrarFormulario(false);
  listar();
  $("#label-productos").hide();
  $("#productosTable").hide();

  $("#facturaForm").on("submit", function (e) {
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
function mostrarModalFacturaImp() {
  $('#modal-factura').modal('show');
}

function mostrarModalFacturaNew() {
  $('#modal-crear-factura').modal('show');
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
        mostrarFormulario(false);
        tabla.ajax.reload();
      } else if (data == "okUpdated") {
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



function mostrar(id) {
  if (id === undefined || id === null || typeof id !== "number") {
    console.error("Invalid id:", id);
    return;
  }

  $.post({
    url: "../ajax/factura.php?op=mostrar",
    data: { iFactEncabezado: id },
    success: function (response, status, jqXHR) {
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

function eliminarProducto(button) {
  const row = button.parentNode.parentNode;
  row.remove();
  actualizarLineas();
}

function actualizarLineas() {
  const filas = document.querySelectorAll('#productosBody tr');
  filas.forEach((fila, index) => {
    fila.children[0].textContent = index + 1;
  });
}

function cargarClientes() {
  var clienteSelect = document.getElementById('idCliente');
  // Verificar si el select ya tiene opciones además de la opción por defecto
  if (clienteSelect.length > 1) {
    return; // Si ya tiene opciones, no hacer nada
  }
  $.ajax({
    url: '../ajax/factura.php?op=listarClientes',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      var clienteSelect = document.getElementById('idCliente');
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

function cargarProducto(selectElement) {
  $.ajax({
    url: '../ajax/factura.php?op=listarProductos',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      var productoSelect = document.getElementById('idProducto');
      data.forEach(function(producto) {
        debugger
        var option = document.createElement('option');
        option.value = producto.prod_id;
        option.textContent = producto.prod_descripcion;
        option.dataset.unidadMedida = producto.prod_um;
        option.dataset.precio = producto.prod_precio;
        productoSelect.appendChild(option);
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Error al cargar los productos:', textStatus, errorThrown);
    }
  });
}

function agregarProducto() {
  $("#label-productos").show();
  $("#productosTable").show();
  const productosBody = document.getElementById('productosBody');
  if (!productosBody) {
    console.error('productosBody no existe');
    return;
  }
  const row = document.createElement('tr');
  const linea = productosBody.children.length + 1;

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

  productosBody.appendChild(row);
  const selectElement = row.querySelector('select[name="producto[]"]');
  if (selectElement) {
    cargarProducto(selectElement);
  } else {
    console.error('selectElement no encontrado');
  }
}

function cargarProducto(selectElement) {
  console.log('selectElement:', selectElement); // Verificar el valor de selectElement
  $.ajax({
    url: '../ajax/factura.php?op=listarProductos',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      data.forEach(function(producto) {
        var option = document.createElement('option');
        option.value = producto.prod_id;
        option.textContent = producto.prod_descripcion;
        option.dataset.unidadMedida = producto.prod_um;
        option.dataset.precio = producto.prod_precio;
        if (selectElement) {
          selectElement.appendChild(option);
        } else {
          console.error('selectElement es undefined');
        }
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Error al cargar los productos:', textStatus, errorThrown);
    }
  });
}

function cargarDatosProducto(selectElement) {
  const selectedOption = selectElement.options[selectElement.selectedIndex];
  const unidadMedida = selectedOption.dataset.unidadMedida;
  const precio = selectedOption.dataset.precio;
  const row = selectElement.closest('tr');
  const unidadMedidaInput = row.querySelector('input[name="unidadMedida[]"]');
  const precioInput = row.querySelector('input[name="precio[]"]');
  unidadMedidaInput.value = unidadMedida;
  precioInput.value = precio;
}


init();
