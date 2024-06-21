<?php
require_once "../config/globla.php";

/**
 * Resive una consulta SQL y la ejecuta.
 *
 * si la consulta no es exitosa, lanza una excepción.
 *
 * @return mysqli la conexión a la base de datos
 * @throws Exception Si ocurrio un error en la consulta
 */
function getConnection() {
    // Variable estatica de la conexión.
    static $connection;

    // Si no hay conexión, se crea una nueva.
    if (!$connection) {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Definir el conjunto de caracteres.
        $connection->set_charset(DB_ENCODE);

        // Si hay un error en la consulta, se lanza una excepción.
        if ($connection->connect_error) {
            throw new Exception("Error en la conexión a la base de datos: " . $connection->connect_error);
        }
    }

    // Se devuelve la conexión.
    return $connection;
}

/**
 * Ejecuta una consulta SQL en la base de datos.
 *
 * @param string $sql La consulta SQL a ejecutar.
 * @return mysqli_result El resultado de la ejecución de la consulta.
 * @throws Exception Si hay un error en la ejecución de la consulta.
 */
function ejecutarConsulta($sql) {
    // Obtener la conexión a la base de datos.
    $connection = getConnection();
    
    // Ejecutar la consulta.
    $result = $connection->query($sql);
    
    // Devolver el resultado de la consulta.
    return $result;
}


/**
 * ejecutarConsultaUnica
 * 
 * La funcion ejecuta una sonsulta SQL y devuelve una fila de datos de la base de datos
 * en forma de Array asociativo.
 *
 * @param  string $sql La consulta SQL a ejecutar.
 * @return array       Un Array asociativo que contiene los datos de la primera fila del resultado de la consulta.
 *                     Si no se devuelven filas, se devuelve un array vacio.
 */
function ejecutarConsultaUnica($sql) {
    // Obtener la conexión a la base de datos.
    $connection = getConnection();

    // Ejecutar la consulta.
    $query = $connection->query($sql);

    // Obtener la primera fila del resultado de la consulta.
    $row = $query->fetch_assoc();

    // Retornar el resultado de la consulta.
    return $row;
}


/**
 * ejecutarConsultaRetornaID
 *
 * Retorna el ID del último registro insertado en la base de datos.
 *
 * @param string $sql La consulta SQL de inserción.
 * @return int El ID del último registro insertado.
 */
function ejecutarConsultaRetornaID($sql){
    // Obtener la conexión a la base de datos.
    $connection = getConnection();

    // Ejecutar la consulta de inserción.
    $connection->query($sql);

    // Obtener el ID del último registro insertado.
    return $connection->insert_id;
}


/**
 * limpiarCadena
 *
 * toma una cadena de texto, la escapa para su uso seguro en consultas SQL
 * y luego la convierte en entidades HTML para mostrarla en una página web
 * sin riesgo de vulnerabilidades
 * 
 * @param  mixed $str
 * @return void
 */
function limpiarCadena($str){
    $connection = getConnection();
    $str = mysqli_real_escape_string($connection,$str);
    return htmlspecialchars($str);
}
