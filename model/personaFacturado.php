<?php
require_once "../config/conection.php";

class personaFacturado{

    function __construct(){

    }

    /**
     * Ejecutar consulta para traer todos los produ
     */
    public function getPersonaFacturado(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_total_facturado_persona";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }
}