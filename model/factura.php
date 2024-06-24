<?php
require_once "../config/conection.php";

class factura{

    function __construct(){

    }
 
    /**
     * Insertar un nuevo poducto en la tabla 'productos'.
     *
     * @param string $descripcion Descripcion del producto.
     * @param float $precio Precio de venta del Producto.
     * @param float $costo Costo del Producto.
     * @param string $unidadMedida Unidad de medida del Producto.
     */
    public function setFactura($factDetalleLinea, $factDetalleCantidad, $idProducto, $factEncabNumero, $facatEncabFecha, $idPersona)
    {
        // Creacion de la consulta SQL para insertar un nuevo producto.
        /*$sql = "INSERT 
                    INTO producto (prod_descripcion, prod_precio, prod_costo, prod_um)
                VALUES ('$descripcion', '$precio', '$costo', '$unidadMedida')";

        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);*/
    }

    /**
     * Actualizar un producto en la tabla 'producto'.
     *
     * @param int $idProducto The ID of the product to update.
     * @param string $descripcion The new description of the product.
     * @param float $precio The new selling price of the product.
     * @param float $costo The new cost of the product.
     * @param string $unidadMedida The new unit of measurement for the product.
     * @return mixed The result of executing the SQL query.
     */
    public function updateFactura ($idProducto, $descripcion, $precio, $costo, $unidadMedida){

        // Creacion de la consulta SQL para Acctualizar un producto.
        $sql = "UPDATE producto SET 
                    prod_descripcion = '$descripcion', 
                    prod_precio = '$precio', 
                    prod_costo = '$costo', 
                    prod_um = '$unidadMedida' 
                WHERE prod_id = '$idProducto'";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }

    /**
     * Traer de la tabla 'producto' todos los registros.
     */
    public function getFacturas( $idFactEncabezado = null){
        if ($idFactEncabezado == null) {
            /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
            $sql = "SELECT * FROM vista_datos_factura_sum";
        } else {
            $sql = "SELECT * FROM vista_datos_factura_sum WHERE fenc_id = '$idFactEncabezado'";
        }
        $result = ejecutarConsulta($sql);
        // Llamado a la funcion ejecutarConsultaunica para ejecutar la consulta.
        return $result->fetch_all(MYSQLI_ASSOC);;
    }

    /**
     * Traer de la tabla 'productos' todos los registros.
     */
    public function getFacturaInfo($idFactEncabezado){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM vista_datos_factura_info WHERE zfenc_id = '$idFactEncabezado'";
        
        $result = ejecutarConsulta($sql);
        // Llamado a la funcion ejecutarConsultaunica para ejecutar la consulta.
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientes(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM persona";
        
        $result = ejecutarConsulta($sql);
        // Llamado a la funcion ejecutarConsultaunica para ejecutar la consulta.
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductos(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM producto";
        
        $result = ejecutarConsulta($sql);
        // Llamado a la funcion ejecutarConsultaunica para ejecutar la consulta.
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}