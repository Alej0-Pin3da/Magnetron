<?php
require_once "../config/conection.php";

class persona{

    function __construct(){

    }

    /**
     * Insertar un nuevo registro en la tabla 'persona'.
     *
     * @param string $nombre Nombre de la persona.
     * @param string $apellido Apellido de la persona.
     * @param string $tipoDocumento Tipo de documento de la persona.
     * @param int $documento documento de la persona.
     * @return mixed The result of executing the SQL query.
     */
    public function setPpersona($nombre, $apellido, $tipoDocumento, $documento){
        // Validar que todos los parámetros tengan un valor válido
        if (empty($nombre) || empty($apellido) || empty($tipoDocumento) || empty($documento)) {
            throw new InvalidArgumentException('Todos los campos son obligatorios');
        }

        // Creacion de la consulta SQL para insertar un nuevo producto.
        // La consulta inserta un nuevo registro en la tabla 'persona'.
        $sql = "INSERT 
                INTO persona (per_nombre, per_apellido, per_tipodocumento, per_documento)
            VALUES ('$nombre', '$apellido', '$tipoDocumento', '$documento')";

        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }

    /**
     * Actualizar una persona en la tabla 'persona'.
     *
     * @param int $idPersona
     * @param string $nombre
     * @param string $apellido
     * @param string $tipoDocumento
     * @param int $documento
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function updatePersona ($idPersona, $nombre, $apellido, $tipoDocumento, $documento){
        // Validar que todos los parámetros tengan un valor válidoe
        if (empty($idPersona) || empty($nombre) || empty($apellido) || empty($tipoDocumento) || empty($documento)) {
            throw new InvalidArgumentException('All fields are required');
        }

        // Creacion de la consulta SQL para insertar un nuevo producto.
        // La consulta actualiza un registro en la tabla 'persona'.
        $sql = "UPDATE persona SET 
                    per_nombre = '$nombre', 
                    per_apellido = '$apellido', 
                    per_tipodocumento = '$tipoDocumento', 
                    per_documento = '$documento' 
                WHERE per_id = '$idPersona'";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }


    /**
     * Traer todos los registros de la tabla 'persona'.
     *
     * @return array Un array asociativo con todos los datos de las personas.
     *               Si no se encontró ningún registro, se devuelve un array vacío.
     */
    public function getPersonas(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
        // La consulta selecciona todos los campos de la tabla 'persona'.
        $sql = "SELECT * FROM persona";
        
        // Llamado a la funcion ejecutarConsulta para ejecutar la consulta.
        return ejecutarConsulta($sql);
    }

    /**
     * Traer un registro de la tabla 'persona' a partir de su id.
     *
     * @param int $idPersona El id de la persona a traer.
     * @return array Un array asociativo con los datos de la persona.
     *               Si no se encontró ningún registro, se devuelve un array vacío.
     */
    public function getPersonaUnico($idPersona){
        // La consulta selecciona todos los campos de la tabla 'persona'
        // donde el id es igual al pasado como parámetro.
        $sql = "SELECT * FROM persona WHERE per_id = '$idPersona'";
        
        // Llamado a la funcion ejecutarConsultaunica para ejecutar la consulta.
        return ejecutarConsultaUnica($sql);
    }
}