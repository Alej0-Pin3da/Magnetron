<?php
require_once "../model/personaFacturado.php";

$personaFacturado = new personaFacturado();

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $personaFacturado->getPersonaFacturado();
        // Se declara un array para almacenar todos los datos
        $data = [];

        foreach ($rspta as $key => $value) {
            $data[] = [
                "0" => $value['per_id'],
                "1" => $value['per_nombre'],  
                "2" => $value['per_apellido'],
                "3" => formatCurrency($value['total_facturado']),
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