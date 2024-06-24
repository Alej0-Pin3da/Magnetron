<?php
require_once "../config/conection.php";

class personaFacturado{

    function __construct(){

    }


    /**
     * Recupera todos los datos de la vista 'vista_total_facturado_persona'.
     *
     * @return mysqli_result The result of the query execution.
     */
    public function getPersonaFacturado() {
        // Consulta SQL para recuperar todos los datos de la vista 'vista_total_facturado_persona'.
        $sql = "SELECT * FROM vista_total_facturado_persona";
        
        // Llameado a la función ejecutarQuery para ejecutar la consulta..
        return ejecutarConsulta($sql);
    }
}