<?php
namespace App\Application\Util;

class Conexion
{

    private static $instance;
    private $con;
    private $db_host = 'localhost';
    private $db_name = 'registro_uber';
    private $db_user = 'root';
    private $db_pass = '';
    public function __construct()
    {
        $this->con = new \PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->db_user, $this->db_pass);
    }

    public static function getInstance(): Conexion
    {
        if (null === self::$instance) {
            self::$instance = new Conexion();
        }

        return self::$instance;
    }

    public function getConnection() {
		return $this->con;
	}
}