<?php
require_once "../model/productoGanancia.php";

$productoGanancia = new ProductoGanancia();

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $productoGanancia->getProductoGanacia();
        //Vamos a declarar un array
        $data = [];

        foreach ($rspta as $key => $value) {
            $data[] = [
                "0" => $value['prod_id'],
                "1" => $value['prod_descripcion'],
                "2" => formatCurrency($value['utilidad_generada']),
                "3" => formatPorcent($value['margen_ganancia']),
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
}

// Función para formatear el valor
function formatCurrency($value) {
    return '$' . number_format($value, 0, '', ".");
}

// Función para formatear el valor
function formatPorcent($value) {
    return number_format($value, 0, '', ".").'%';
}