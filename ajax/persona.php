<?php
require_once "../model/persona.php";

$persona = new persona();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPersona = isset($_POST['idPersona']) ? limpiarCadena($_POST['idPersona']) : "";
    $nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
    $apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
    $tipoDocumento = isset($_POST["tipoDocumento"]) ? limpiarCadena($_POST["tipoDocumento"]) : "";
    $documento = isset($_POST["documento"]) ? limpiarCadena($_POST["documento"]) : "";
}

/**
 * Maneje diferentes operaciones según el parámetro 'op'.
 *
 * @throws None
 * @return void
 */
switch ($_GET["op"]) {
    //Manejar guardar o editar una persona
    case 'guardarEditar':
        if (empty($idPersona)) {
            // Crea un nuevo registro de Persona.
            $rspta = $persona->setPpersona($nombre, $apellido, $tipoDocumento, $documento);           
            // Devuelve un mensaje de éxito o error.
            echo $rspta ? "ok" : "PERSONA NO SE PUDO REGISTRAR";
        } else {
            // Actualiza un registro de Persona.
            $rspta = $persona->updatePersona($idPersona, $nombre, $apellido, $tipoDocumento, $documento);
            // Devuelve un mensaje de éxito o error.
            echo $rspta ? "okUpdated" : "PERSONA NO SE PUDO ACTUALIZAR";
        }        
    break;

   // Manejar la lista de facturas
    case 'listar':
        // Obtenga todos los registros de Persona.
        $rspta = $persona->getPersonas();
        // Declarar una matriz para contener los datos formateados
        $data = [];

        // Iterar sobre los resultados de la consulta y agregarlos a la matriz.
        foreach ($rspta as $key => $value) {
            $data[] = [
                "0" => $value['per_id'],
                "1" => $value['per_nombre'],  
                "2" => $value['per_apellido'],
                "3" => $value['per_tipodocumento'],
                "4" => $value['per_documento'],
                "5" => '<button class="btn btn-warning btn-sm" onclick="mostrar(' . $value['per_id'] . ')"><i class="fa fa-pencil"></i></button>',
            ];
        }   
        // Iterar sobre los resultados de la consulta y agregarlos a la matriz.
        $results = [    
            "sEcho"=>1, //Información para el datatables    
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros al datatable
            "aaData"=>$data
        ];
        // Ejecutar la respuesta en formato JSON
        echo json_encode($results, JSON_UNESCAPED_UNICODE);
    break;

    //Manejar mostrar una Persona
    case 'mostrar':
        // Obtenga el registro de Persona por ID.
        $rspta = $persona->getPersonaUnico($idPersona);
        // Ejecutar la respuesta en formato JSON
        echo json_encode($rspta, JSON_UNESCAPED_UNICODE);
    break;
}
