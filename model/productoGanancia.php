<?php
require_once "../config/conection.php";

class productoGanancia{

    function __construct(){

    }

    /**
     * Cargar informacion de la Vista para la Ganancia de cada producto.
     */
    public function getProductoGanacia(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_productos_margen_canancia";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }
}