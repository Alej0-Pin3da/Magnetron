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
 * This switch statement handles the different operations for managing Persona data.
 *
 * @throws None
 * @return void
 */
switch ($_GET["op"]) {
    /**
     * This case handles saving or updating a Persona record.
     */
    case 'guardarEditar':
        // If the ID is empty, a new record is being created.
        if (empty($idPersona)) {
            // Create a new Persona record.
            $rspta = $persona->setPpersona($nombre, $apellido, $tipoDocumento, $documento);           
            // Return a success or error message.
            echo $rspta ? "ok" : "PERSONA NO SE PUDO REGISTRAR";
        } else {
            // Update an existing Persona record.
            $rspta = $persona->updatePersona($idPersona, $nombre, $apellido, $tipoDocumento, $documento);
            // Return a success or error message.
            echo $rspta ? "okUpdated" : "PERSONA NO SE PUDO ACTUALIZAR";
        }        
        break;

    /**
     * This case handles retrieving all Persona records and formatting them for the datatable.
     */
    case 'listar':
        // Get all Persona records.
        $rspta = $persona->getPersonas();
        // Declare an array to hold the formatted data.
        $data = [];

        // Loop through each record and format it for the datatable.
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
        // Prepare the data for the datatable.
        $results = [    
            "sEcho"=>1, //Información para el datatables    
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros al datatable
            "aaData"=>$data
        ];
        // Return the formatted data as JSON.
        echo json_encode($results, JSON_UNESCAPED_UNICODE);
        break;

    /**
     * This case handles retrieving a single Persona record by ID.
     */
    case 'mostrar':
        // Get the Persona record by ID.
        $rspta = $persona->getPersonaUnico($idPersona);
        // Return the record as JSON.
        echo json_encode($rspta, JSON_UNESCAPED_UNICODE);
        break;
}
