<?php
require_once "../model/factura.php";

$factura = new factura();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Decodificar el JSON recibido
    $data = json_decode(file_get_contents("php://input"), true);

    // Encabezado
    $idCliente = isset($data['idCliente']) ? limpiarCadena($data['idCliente']) : "";

    // Detalle
    $productos = isset($data['productos']) ? $data['productos'] : [];

    foreach ($productos as $producto) {
        $cantidad = isset($producto['cantidad']) ? limpiarCadena($producto['cantidad']) : "";
        $idProducto = isset($producto['idProducto']) ? limpiarCadena($producto['idProducto']) : "";
        $linea = isset($producto['linea']) ? limpiarCadena($producto['linea']) : "";
    }
}

/**
 * Maneje diferentes operaciones según el parámetro 'op'.
 *
 * @throws None
 * @return void
 */
switch ($_GET["op"]) {
    // Manejar guardar o editar una factura
    case 'guardarEditar':
        if (!empty($idCliente)) {
            // Establecer el encabezado de la factura
            $idEncabezado = $factura->setFacturaEncabezado($idCliente);

            if ($productos) {
                // Establecer el detalle de la factura
                $rspta = $factura->setFacturaDetalle($productos);
                echo $rspta ? "ok" : "PRODUCTO NO SE PUDO REGISTRAR";
            }
        } else {
            echo "CLIENTE NO SE PUDO REGISTRAR";
        }       
    break;

    // Manejar la lista de facturas
    case 'listar':
        $rspta = $factura->getFacturas();
        // Inicializar una matriz para almacenar los datos.
        $data = [];

        // Iterar sobre los resultados de la consulta y agregarlos a la matriz.
        foreach ($rspta as $key => $value) {
            $data[] = [
                "0" => $value['fenc_numero'],
                "1" => $value['per_nombre']." ".$value['per_apellido'],  
                "2" => $value['total_cantidad'],
                "3" => formatCurrency($value['total_venta']),
                "4" => '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $value['fenc_id'] . '); mostrarModalFacturaImp();"><i class="fa fa-pencil"></i></button>',
            ];
        }  

        // Iterar sobre los resultados de la consulta y agregarlos a la matriz.
        $results = [   
            "sEcho"=>1, // Información para el datatables   
            "iTotalRecords"=>count($data), // enviar el total de registros al datatable
            "iTotalDisplayRecords"=>count($data), // enviar el total de registros a visualizar
            "aaData"=>$data
        ];

        // Ejecutar la respuesta en formato JSON
        echo json_encode($results, JSON_UNESCAPED_UNICODE);
    break;
    
    // Manejar mostrar una factura
    case 'mostrar':
        // Capturar la variable enviada vía POST
        $iFactEncabezado = isset($_POST['iFactEncabezado']) ? intval($_POST['iFactEncabezado']) : 0;
        $rspta = $factura->getFacturas($iFactEncabezado);
        $rsptaInfo = $factura->getFacturaInfo($iFactEncabezado);

        // Inicializar la respuesta
        $response = [
            'fecha' => $rspta[0]['fenc_fecha'],
            'nombre' => $rspta[0]['per_nombre'],
            'tipoDocumento' => $rspta[0]['per_tipodocumento'],
            'documento' => $rspta[0]['per_documento'],
            'idFactura' => $rspta[0]['fenc_numero'],
            'total' => 0, // Inicializar el total en 0
            'detalles' => []
        ];

        // Añade los detalles de la factura a la respuesta.
        foreach ($rsptaInfo as $detalle) {
            $detalleTotal = $detalle['prod_precio'] * $detalle['fdet_cantidad'];
            $response['detalles'][] = [
                'idProd' => $detalle['prod_id'],
                'descripcion' => $detalle['prod_descripcion'],
                'unidadMedida' => $detalle['prod_um'],
                'precio' => formatCurrency($detalle['prod_precio']),
                'linea' => $detalle['fdet_linea'],
                'cantidad' => $detalle['fdet_cantidad'],
                'total' => formatCurrency($detalleTotal)
            ];
            // Añade el total de la factura a la respuesta.
            $response['total'] += $detalleTotal;
        }

        // Aplicar formato de moneda al total
        $response['total'] = formatCurrency($response['total']);

        // Devuelve la respuesta codificada en JSON
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    break;
    // Manejar la lista de clientes
    case 'listarClientes':
        $rspta = $factura->getClientes();
        echo json_encode($rspta, JSON_UNESCAPED_UNICODE);
    break;
    // Manejar la lista de productos
    case 'listarProductos':
        $rspta = $factura->getProductos();
        echo json_encode($rspta, JSON_UNESCAPED_UNICODE);
    break;
}

/**
 * Da formato a un valor como una cadena de moneda.
 *
 * @param float $value
 * @return string
 */
function formatCurrency($value) {
    // Formatear el valor como una cadena de moneda, sin decimales y usando
    // el punto como separador decimal.
    return '$' . number_format($value, 0, '', ".");
}
