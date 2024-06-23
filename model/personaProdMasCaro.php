<?php
require_once "../config/conection.php";

class personaProdMasCaro{

    function __construct(){

    }

    /**
     * Ejecutar consulta para traer todos los produ
     */
    public function getPersonaProdMasCaro(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_producto_mas_caro";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }
}