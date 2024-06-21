var tabla;

function init() {
    mostrarFormulario(false);
    listar();
}

function limpiar() {
    $("#txtId").val("");
    $("#txtNombre").val("");
    $("#txtStock").val("");
    $("#txtPrecio").val("");
}

function mostrarFormulario(x){
    limpiar();

    if(x){
        $("#listadoProducto").hide();
        $("#formProducto").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnAgregar").hide();
    } else {
        $("#listadoProducto").show();
        $("#formProducto").hide();
        $("#btnGuardar").prop("disabled", true);
        $("#btnAgregar").show();
    }
}

function cancelarFormulario(){
    limpiar();
    mostrarFormulario(false);
}

/**
 * Function to list the products in a DataTable.
 * The data is fetched from the server using AJAX.
 * The DataTable is configured with pagination and sorting capabilities.
 * Buttons for copying, exporting to Excel and CSV are also added.
 */
function listar() {
    // Initialize the DataTable
    tabla = $("#tblListado").DataTable({
        // Activate DataTables processing
        "aProcessing": true,
        // Enable server-side pagination and filtering
        "aServerSide": true,
        // Define the elements of the table control
        dom: 'Bfrtip',
        // Add buttons for copying, exporting to Excel and CSV
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        // Specify the AJAX request details
        "ajax": {
            url: '../ajax/producto.php?op=listar', // Server-side script to handle the request
            type: "get", // Request method
            dataType: "json", // Expected data type of the response
            // Error handling function
            error: function (e) {
                console.log(e.responseText);
            }
        },
        // Destroy the existing DataTable if it exists
        "bDestroy": true,
        // Set the number of rows to display per page
        "iDisplayLength": 5,
        // Set the default sort order of the table
        "order": [[0, "asc"]]
    });
}

init();