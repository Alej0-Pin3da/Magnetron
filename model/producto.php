<?php
require_once "../config/conection.php";

class productos{

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
    public function setProducto($descripcion, $precio, $costo, $unidadMedida)
    {
        // Creacion de la consulta SQL para insertar un nuevo producto.
        $sql = "INSERT 
                    INTO producto (prod_descripcion, prod_precio, prod_costo, prod_um)
                VALUES ('$descripcion', '$precio', '$costo', '$unidadMedida')";

        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }

    /**
     * Actualizar un producto en la tabla 'producto'.
     *
     * @param int $idProducto
     * @param string $descripcion
     * @param float $precio
     * @param float $costo
     * @param string $unidadMedida
     * @return mixed 
     */
    public function updateProducto ($idProducto, $descripcion, $precio, $costo, $unidadMedida){
        // Creación de la consulta SQL para actualizar un producto.
        // La cláusula SET actualiza los valores de las columnas de la cláusula WHERE.

        // Consulta SQL para actualizar el producto.
        $sql = "UPDATE producto SET 
                    prod_descripcion = '$descripcion', 
                    prod_precio = '$precio', 
                    prod_costo = '$costo', 
                    prod_um = '$unidadMedida' 
                WHERE prod_id = '$idProducto'";
        
        // Llamado a la función ejecutarConsulta para ejecutar la consulta SQL.
        return ejecutarConsulta($sql);
    }


    /**
     * Traer de la tabla 'productos' todos los registros.
     *
     * @return mixed Retorna un array de objetos con los datos de los productos.
     */
    public function getProductos()
    {
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM producto"; // Consulta SQL para traer todos los productos.
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }

   
    /**
     * Recupere un solo producto de la tabla 'producto' según su identificación.
     *
     * @param int $idProducto
     * @return mixed
     */
    public function getProductoUnico($idProducto){
        // Creación de la consulta SQL para seleccionar un solo producto de la tabla 'producto'.
        // La cláusula WHERE restringe la selección al producto con la identificación especificada.
        
        // Consulta SQL para recuperar el producto.
        $sql = "SELECT * FROM producto WHERE prod_id = '$idProducto'";
        
        // Llama a la función 'ejecutarConsultaUnica' para ejecutar la consulta SQL y devolver un objeto de una sola fila.
        return ejecutarConsultaUnica($sql);
    }
}