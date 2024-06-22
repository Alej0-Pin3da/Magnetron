<?php
require_once "../config/conection.php";

class productoCantidad{

    function __construct(){

    }

    /**
     * Traer de la tabla 'producto' todos los registros.
     */
    public function getProductoCantidad(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_total_facturado_persona";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }
}