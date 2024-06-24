<?php
require_once "../config/conection.php";

class personaProdMasCaro{

    function __construct(){

    }


    /**
     * Recupera de la base de datos el detalle del producto más caro por persona.
     *
     * @return array
     */
    public function getPersonaProdMasCaro() {
        // Consulta SQL para seleccionar todas las columnas de la vista 'vista_producto_mas_caro'.
        $sql = "SELECT * FROM vista_producto_mas_caro";
        
        // Llamado a la función 'ejecutarConsulta' para ejecutar la consulta SQL y devolver el resultado.
        return ejecutarConsulta($sql);
    }
}