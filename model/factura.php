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
    public function setFacturaEncabezado($idCliente){
        $lastNumero = $this->getUltimofactNumero();
        $lastNumero = $lastNumero + 1;
        $fechaActual = date('Y-m-d');
        // Creacion de la consulta SQL para insertar un nuevo producto.
        $sql = "INSERT 
                    INTO fact_encabezado (fenc_numero, fenc_fecha, zper_id)
                VALUES ('$lastNumero', '$fechaActual', '$idCliente')";

        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        $insertEncabezado = ejecutarConsulta($sql);

        if ($insertEncabezado) {
            return $insertEncabezado;
        } else {
            return false;
        }
    }

    /**
     * Insertar detalles de la factura en la tabla 'fact_detalle'.
     *
     * @param array $productos Array de productos con sus respectivas cantidades y lineas.
     * @return string|bool Retorna 'ok' si la inserción fue exitosa, de lo contrario retorna false.
     */
    public function setFacturaDetalle($productos) {
        $lastEncfactId = $this->getUltimoEncFacId();
        
        // Iterar sobre cada producto y realizar la inserción en la tabla 'fact_detalle'
        foreach ($productos as $producto) {
            $cantidad = isset($producto['cantidad']) ? limpiarCadena($producto['cantidad']) : "";
            $idProducto = isset($producto['idProducto']) ? limpiarCadena($producto['idProducto']) : "";
            $linea = isset($producto['linea']) ? limpiarCadena($producto['linea']) : "";

            // Crear la consulta SQL para insertar un nuevo producto en 'fact_detalle'
            $sql = "INSERT INTO fact_detalle (fdet_linea, fdet_cantidad, zprod_id, zfenc_id)
                    VALUES ('$linea', '$cantidad', '$idProducto', '$lastEncfactId')";
            
            // Ejecutar la consulta para insertar el detalle de la factura
            $insertDet = ejecutarConsulta($sql);
        }

        // Verificar si la inserción fue exitosa
        if ($insertDet) {
            return "ok"; // Retornar 'ok' si la inserción fue exitosa
        } else {
            return false; // Retornar false si la inserción falló
        }
    }

    /**
     * Obtiene el último número de factura registrado en la tabla 'fact_encabezado'.
     *
     * @return int|null El último número de factura registrado, o null si no hay resultados.
     */
    public function getUltimofactNumero() {
        // Crear la consulta SQL para obtener el último número de factura registrado
        $sql = "SELECT MAX(fenc_numero) AS lastNumero FROM fact_encabezado";
        
        // Ejecutar la consulta
        $result = ejecutarConsulta($sql);
        
        // Verificar si la consulta devolvió algún resultado
        if ($result) {
            // Obtener la fila de resultados
            $row = $result->fetch_assoc();
            
            // Devolver el último número de factura
            return $row['lastNumero'];
        } else {
            // Devolver null en caso de error
            return null;
        }
    }

    /**
     * Obtiene el ID del último registro de factura en la tabla 'fact_encabezado'.
     *
     * @return int|null El ID del último registro de factura, o null si no hay resultados.
     */
    public function getUltimoEncFacId() {
        // Crear la consulta SQL para obtener el ID del último registro de factura
        $sql = "SELECT MAX(fenc_id) AS lastNumero FROM fact_encabezado";
        
        // Ejecutar la consulta
        $result = ejecutarConsulta($sql);
        
        // Verificar si la consulta devolvió algún resultado
        if ($result) {
            // Obtener la fila de resultados
            $row = $result->fetch_assoc();
            
            // Devolver el ID del último registro de factura
            return $row['lastNumero'];
        } else {
            // Devolver null en caso de error
            // (o algún valor por defecto en caso de error)
            return null;
        }
    }
    

    /**
     * Actualiza un registro de la tabla 'producto'.
     *
     * @param int $idProducto 
     * @param string $descripcion 
     * @param float $precio 
     * @param float $costo 
     * @param string $unidadMedida 
     * @return mixed 
     */
    public function updateFactura($idProducto, $descripcion, $precio, $costo, $unidadMedida) {
        // Crear la consulta SQL para actualizar un registro de la tabla 'producto'.
        $sql = "UPDATE producto "
            . "SET prod_descripcion = '$descripcion', "
            . "prod_precio = '$precio', "
            . "prod_costo = '$costo', "
            . "prod_um = '$unidadMedida' "
            . "WHERE prod_id = '$idProducto'";

        // Llamado a la funcion ejecutarConsultaunica para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }

    /**
     * Traer de la tabla 'producto' todos los registros.
     *
     * @param int|null $idFactEncabezado Opcional. Si se proporciona, se filtrarán los resultados por este ID.
     * @return array Una matriz asociativa con los resultados de la consulta.
     */
    public function getFacturas($idFactEncabezado = null)
    {
        // Si no se proporciona un ID de factura, se traerán todos los registros.
        // De lo contrario, se filtrarán los resultados por este ID.
        if ($idFactEncabezado == null) {
            // Creación de la consulta SQL para obtener todos los registros de la tabla 'producto'.
            $sql = "SELECT * FROM vista_datos_factura_sum";
        } else {
            // Creación de la consulta SQL para obtener los registros filtrados por el ID de factura.
            $sql = "SELECT * FROM vista_datos_factura_sum WHERE fenc_id = '$idFactEncabezado'";
        }
        
        // Ejecución de la consulta SQL.
        $result = ejecutarConsulta($sql);
        
        // Llamado a la función ejecutarConsulta para ejecutar la consulta.
        // El método fetch_all devuelve todos los resultados de la consulta como un array asociativo.
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Obtiene los datos de un registro de la tabla 'factura' basado en su ID.
     *
     * @param int $idFactEncabezado
     * @return array Un arreglo asociativo con los datos del registro
     */
    public function getFacturaInfo($idFactEncabezado)
    {
        // Crea la consulta SQL para obtener los datos de un registro de la tabla 'factura'
        $sql = "SELECT * FROM vista_datos_factura_info WHERE zfenc_id = '$idFactEncabezado'";
        
        // Ejecuta la consulta
        $result = ejecutarConsulta($sql);
        
        // Retorna los datos del registro como un array asociativo
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Obtiene todos los registros de la tabla 'persona'.
     *
     * @return array
     */
    public function getClientes(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        $sql = "SELECT * FROM persona";
        
        // Ejecutar la consulta.
        $result = ejecutarConsulta($sql);
        
        // Retorna todos los registros de la tabla 'persona' en un array asociativo.        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Obtiene todos los registros de la tabla 'producto'.
     *
     * @return array
     */
    public function getProductos(){
        // Creacion de la consulta SQL para traer todos los registros de la tabla 'producto'.
        $sql = "SELECT * FROM producto";
        
        // Ejecutar la consulta.
        $result = ejecutarConsulta($sql);
        
        // Retorna todos los registros de la tabla 'producto' en un array asociativo.
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}