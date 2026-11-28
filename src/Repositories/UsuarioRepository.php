<?php

/* Repositorio: clase encargada de comunicarse con la BD para realizar operaciones sobre una entidad. Ejecuta, insertar, consultas y actualizacion */

/* require once es una instruccion que incluye un archivo dentro de esta carpeta. Y este permite incluir una unica vez el archivo */

/* DIR devuelve la ruta de la carptera donde esta el archivo actual */
require_once __DIR__ . '/../Database/DatabaseConnection.php';

class UsuarioRepository
{
    /* aqui guardamos el objeto PDO que nos devuelve DatabaseConnection */
    private $connection;

    /* contructor que se ejecuta automaticamente cuando llamamos la clase UsuarioRepository desde otro archivo */
    public function __construct()
    {
        /* crea un objeto de la clase DatabaseConnection y lo guarda en una variable */

        $database = new DatabaseConnection;

        /* guardamos el objeto connect en la variable/propiedad del repositorio ($connection) */

        $this->connection = $database->connect();
    }

    /* metodo para registrar usuario donde recibe los 6 datos necesarios para un usuario */

    public function registrar(
        $nombres,
        $apellidos,
        $documento,
        $correo,
        $centro,
        $contrasenaHash,
        $idRol
    ) {
        $sql = "INSERT INTO usuario
        (nombres, apellidos, documento, correo, centro, contrasena_hash, id_rol)
        VALUES
        (:nombres, :apellidos, :documento, :correo, :centro, :contrasena_hash, :id_rol)";

        /* utilizamos la conexion anteriormente guardada this->connection = $database->connect() */

        /* prepare sirve para la consulta sql para ejecutarla posteriormente */

        $statement = $this->connection->prepare($sql);

        /* ejecuta la consulta preparada mediante un arreglo [] que permite guardar varios valores en una variable */

        /* return muestra el resultado si se realizo correctamente o no */
        return $statement->execute([
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':documento' => $documento,
            ':correo' => $correo,
            ':centro' => $centro,
            ':contrasena_hash' => $contrasenaHash,
            ':id_rol' => $idRol
        ]);
    }

    public function obtenerIdRolUsuario()
    {
        $sql = "SELECT id_rol FROM rol WHERE tipo = :tipo";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ':tipo' => 'USUARIO'
        ]);

        /* devuelve el primer registro que haya en esta tabla, fetch devolveria todos los campos */
        return $statement->fetchColumn();
    }

    public function existeDocumentoOCorreo($documento, $correo)
    {
        $sql = "SELECT COUNT(*) FROM usuario WHERE documento = :documento OR correo = :correo";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ':documento' => $documento,
            ':correo' => $correo
        ]);

        return $statement->fetchColumn() > 0;
    }
}