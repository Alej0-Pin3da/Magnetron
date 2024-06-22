<?php
require_once "../model/productoUtilidad.php";

$productoUtilidad = new productoUtilidad();

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $productoUtilidad->getProductoUtilidad();
        //Vamos a declarar un array
        $data = [];

        foreach ($rspta as $key => $value) {
            $data[] = [
                "0" => $value['prod_id'],
                "1" => $value['prod_descripcion'],  
                "2" => formatCurrency($value['utilidad_generada']),
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