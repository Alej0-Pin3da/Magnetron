<?php
require_once "../config/conection.php";

class productoCantidad{

    function __construct(){

    }


    /**
     * Recupera toda la información del producto de la base de datos.
     *
     * @return array|null
     */
    public function getProductoCantidad(){
        // Consulta SQL para seleccionar toda la información del producto de la base de datos.
        $sql = "
            SELECT * 
            FROM vista_productos_cantidad_facturada_desc
        ";
        
       // Llama a la función ejecutarQuery para ejecutar la consulta SQL y devolver el resultado
        return ejecutarConsulta($sql);
    }
}