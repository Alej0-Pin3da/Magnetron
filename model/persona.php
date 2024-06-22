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
     * Update a person in the 'persona' table.
     *
     * @param int $idPersona The ID of the person to update.
     * @param string $nombre The new name of the person.
     * @param string $apellido The new last name of the person.
     * @param string $tipoDocumento The new type of document of the person.
     * @param int $documento The new document of the person.
     * @return mixed The result of executing the SQL query.
     * @throws InvalidArgumentException if any of the parameters are empty.
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
     * Traer de la tabla 'producto' todos los registros.
     */
    public function getPersonas(){
        /// Creacion de la consulta SQL para Acctualizar traer todos los productos.
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