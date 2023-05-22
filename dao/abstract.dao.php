<?php
//Clase abstracta para las operaciones CRUD en la base de datos que puede ser reutilizada 
//en cualquier clase que represente una tabla
abstract class AbstractDao {
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = 'root';
    protected $db_name = 'nomina-php';
    protected $query;
    protected $rows = array();
    private $conn;

    //Metodos CRUD (deben implementarse obligatoriamente en las subclases de esta clase)
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete();

    //Se abre la conexion
    private function open_connection() {
        $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
    }

    //Se cierra la conexion
    private function close_connection() {
        $this->conn->close();
    }

    //Ejecuta una consulta sin retornar resultados (save, update, delete)
    protected function execute_single_query() {
        $this->open_connection();
        $this->conn->query($this->query);
        $this->close_connection();
    }

    //Ejecuta una consulta retornando resultados (read)
    protected function get_results_from_query() {
        $this->open_connection();
        $result = $this->conn->query($this->query);
        while ($row = $result->fetch_assoc()) {
            $this->rows[] = $row;
        }
    }        
}
?>
