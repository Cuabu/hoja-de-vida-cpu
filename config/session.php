<?php
class Conexion {
    private $servername = "localhost";
    private $username = "usuario";
    private $password = "114412345@";
    private $dbname = "hvcpu";
    private $conn;

    // Constructor
    public function __construct() {
        // Crear conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConexion() {
        return $this->conn;
    }

    // Método para cerrar la conexión
    public function cerrarConexion() {
        $this->conn->close();
    }
}
?>