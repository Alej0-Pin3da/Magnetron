<?php
require_once "../config/conection.php";

class productoUtilidad{

    function __construct(){

    }

    /**
     * Cargar informacion de la Vista para la utilidad de cada producto.
     */
    public function getProductoUtilidad(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_productos_utilidad_facturacion";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }
}