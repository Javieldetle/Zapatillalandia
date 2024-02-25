<?php
// conexion.php



class Database {
    private $host = "localhost";
    private $db_name = "tiendadb";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para activar el manejo de errores
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }

    // Función para iniciar sesión
    public function iniciarSesion($user, $key) {
        $query = "SELECT nombre, clave FROM usuarios WHERE nombre = :user AND clave = :key";
        
        try {
            $stmt = $this->conn->prepare($query);

            // Bind de parámetros
            $stmt->bindParam(":user", $user);
            $stmt->bindParam(":key", $key);

            // Ejecutar consulta
            $stmt->execute();

            // Obtener resultado
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró el usuario
            if ($usuario) {
                // Guardar el nombre de usuario en la sesión
                $_SESSION['nombre_usuario'] = $usuario['nombre'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al iniciar sesión: " . $e->getMessage();
            return false;
        }
    }
}
?>
