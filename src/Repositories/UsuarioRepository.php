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

    public function obtenerTodos()
    {
        $sql = "SELECT
                id_usuario,
                nombres,
                apellidos,
                documento,
                correo,
                centro,
                tipo_cuenta,
                fecha_registro,
                estado,
                id_rol
            FROM usuario
            ORDER BY id_usuario DESC";

        $statement = $this->connection->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar(array $datos): bool
    {
        $sql = "UPDATE usuario
            SET nombres = :nombres,
                apellidos = :apellidos,
                documento = :documento,
                correo = :correo,
                estado = :estado,
                centro = :centro,
                tipo_cuenta = :tipo_cuenta,
                id_rol = :id_rol";

        // Si se ingresó una nueva contraseña, también se actualiza.
        if (isset($datos['contrasena_hash'])) {
            $sql .= ", contrasena_hash = :contrasena_hash";
        }

        $sql .= " WHERE id_usuario = :id_usuario";

        $statement = $this->connection->prepare($sql);

        $parametros = [
            ':nombres' => $datos['nombres'],
            ':apellidos' => $datos['apellidos'],
            ':documento' => $datos['documento'],
            ':correo' => $datos['correo'],
            ':estado' => $datos['estado'],
            ':centro' => $datos['centro'],
            ':tipo_cuenta' => $datos['tipo_cuenta'],
            ':id_rol' => $datos['id_rol'],
            ':id_usuario' => $datos['id_usuario']
        ];

        if (isset($datos['contrasena_hash'])) {
            $parametros[':contrasena_hash'] = $datos['contrasena_hash'];
        }

        return $statement->execute($parametros);
    }
}