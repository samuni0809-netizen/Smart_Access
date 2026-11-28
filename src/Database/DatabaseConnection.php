

<?php /* Apertura PHP */

/* clase para llamarla en todos los archivos de conexion a la base de datos */

class DatabaseConnection
{

    /* variables/propiedades privadas que guardan la informacion que la clase necesita para conectar a la base de datos */

    /* son private porque no se puede acceder a ellas a menos que sea dentro de esta misma clase */

    private $host = "127.0.0.1";
    private $database = "smart_access";
    private $username = "root";
    private $password = "";

    /* funcion (metodo, al estar dentro de una clase) que realiza una tarea especifica */

    /* es public porque desde otras partes del proyecto podremos llamarla y utilizarla */

    public function connect()
    {
        try {

            /* new crea un objeto PDO Data Objects que permite trabajar con bases de datos */

            $connection = new PDO(
                /* DNS Data Source Name, que le indica a PDO que tipo de base de datos vamos a usar y donde esta */

                "mysql:host=$this->host;port=3307;dbname=$this->database;charset=utf8mb4",
                $this->username,
                $this->password
            );

            /* un atributo es una configuracion de un objeto, en este caso PDO */

            $connection->setAttribute(
                /* ATTR es una excepcion de PDO, le indicamos que si ocurre un error no lo ignore y utilice el try y catch*/
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $connection;
        } catch (PDOException $error) {
            /* termina la ejecucion del programa si hay errores y muestra el contenido (mensaje) que entregamos */
            die("Error de conexión" . $error->getMessage());
        }
    }
}
