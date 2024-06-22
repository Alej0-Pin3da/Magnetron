<?php
require_once "../model/producto.php";

$producto = new productos();

// Se llama a la funcion LimpiarCadena para evitar Inyecciones SQL.
/*$idProducto = isset($_POST['idProducto']) ? limpiarCadena($_POST['idProducto']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
$precio = isset($_POST["precio"]) ? limpiarCadena($_POST["precio"]) : "";
$costo = isset($_POST["costo"]) ? limpiarCadena($_POST["costo"]) : "";
$unidadMedida = isset($_POST["unidadMedida"]) ? limpiarCadena($_POST["unidadMedida"]) : "";
*/

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
            $rspta = $producto->setProducto($descripcion, $precio, $costo, $unidadMedida);            
            echo $rspta ? "ok" : "PRODUCTO NO SE PUDO REGISTRAR";
        } else {
            $rspta = $producto->updateProducto($idProducto, $descripcion, $precio, $costo, $unidadMedida);
            echo $rspta ? "okUpdated" : "PRODUCTO NO SE PUDO ACTUALIZAR";
        }        
        break;

    case 'listar':
        $rspta = $producto->getProductos();
        //Vamos a declarar un array
        $data = [];

        foreach ($rspta as $key => $value) {
            $data[] = [
                "0" => $value['prod_id'],
                "1" => $value['prod_descripcion'],  
                "2" => $value['prod_precio'],
                "3" => $value['prod_costo'],    
                "4" => $value['prod_um'],
                "5" => '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $value['prod_id'] . ')"><i class="fa fa-pencil"></i></button>',
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
        $rspta = $producto->getProductoUnico($idProducto);
        echo json_encode($rspta, JSON_UNESCAPED_UNICODE);
        break;
}