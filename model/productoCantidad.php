<?php
require_once "../config/conection.php";

class productoCantidad{

    function __construct(){

    }

    /**
     * Ejecutar consulta para traer todos los produ
     */
    public function getProductoCantidad(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_productos_cantidad_facturada_desc";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }
}