<?php
require_once "../model/factura.php";

$factura = new factura();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = isset($_POST['idProducto']) ? limpiarCadena($_POST['idProducto']) : "";
    $descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
    $precio = isset($_POST["precio"]) ? limpiarCadena($_POST["precio"]) : "";
    $costo = isset($_POST["costo"]) ? limpiarCadena($_POST["costo"]) : "";
    $unidadMedida = isset($_POST["unidadMedida"]) ? limpiarCadena($_POST["unidadMedida"]) : "";
}

switch ($_GET["op"]) {
    case 'guardarEditar':
        if (empty($idProducto)) {
            //$rspta = $factura->setFactura($descripcion, $precio, $costo, $unidadMedida);            
            //echo $rspta ? "ok" : "PRODUCTO NO SE PUDO REGISTRAR";
        } else {
            //$rspta = $factura->updateProducto($idProducto, $descripcion, $precio, $costo, $unidadMedida);
            //echo $rspta ? "okUpdated" : "PRODUCTO NO SE PUDO ACTUALIZAR";
        }        
        break;

        case 'listar':
            $rspta = $factura->getFacturas();
            //Vamos a declarar un array
            $data = [];
    
            foreach ($rspta as $key => $value) {
                $data[] = [
                    "0" => $value['fenc_numero'],
                    "1" => $value['per_nombre']." ".$value['per_apellido'],  
                    "2" => $value['total_cantidad'],
                    "3" => formatCurrency($value['total_venta']),
                    "4" => '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $value['fenc_id'] . '); mostrarModal();"><i class="fa fa-pencil"></i></button>',
                ];
            }   
            $results = [    
                "sEcho"=>1, //Información para el datatables    
                "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data), //enviamos el total registros al datatable
                "aaData"=>$data
            ];
            echo json_encode($results, JSON_UNESCAPED_UNICODE);
            break;
    
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
                'total' => 0, // Inicializar el total
                'detalles' => []
            ];

            // Agregar los detalles de la factura
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
                // Sumar al total general
                $response['total'] += $detalleTotal;
            }

            // Aplicar formato de moneda a Total
            $response['total'] = formatCurrency($response['total']);

            // Enviar la respuesta
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;
    }

function formatCurrency($value) {
    return '$' . number_format($value, 0, '', ".");
}