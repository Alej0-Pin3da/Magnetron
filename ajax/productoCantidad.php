<?php
require_once "../model/productoCantidad.php";

$productoCantidad = new productoCantidad();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = isset($_POST['idProducto']) ? limpiarCadena($_POST['idProducto']) : "";
    $descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
    $precio = isset($_POST["precio"]) ? limpiarCadena($_POST["precio"]) : "";
    $costo = isset($_POST["costo"]) ? limpiarCadena($_POST["costo"]) : "";
    $unidadMedida = isset($_POST["unidadMedida"]) ? limpiarCadena($_POST["unidadMedida"]) : "";
}

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $productoCantidad->getProductoCantidad();
        //Vamos a declarar un array
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