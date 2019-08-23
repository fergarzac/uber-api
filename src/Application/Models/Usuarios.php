<?php
namespace App\Application\Models;

use App\Application\Util\Conexion;

class Usuarios {
    protected $con;
    public function __construct()
    {
        $this->con = Conexion::getInstance();
    }

    public function getUsuarios() {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Usuarios");
            $stmt->execute();
            $data = [];
            while ($fila = $stmt->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
                array_push($data, $fila);
            }
        }catch(PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }

    public function getUser($data) {
        try {
            $usuario = $data['usuario'];
            $contraseña = $data['contraseña'];
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Usuarios WHERE usuario = :usuario AND contraseña = :pass");
            $stmt->bindValue(':usuario', $usuario, \PDO::PARAM_STR);
            $stmt->bindValue(':pass', $contraseña, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $rows = $stmt->rowCount();
            if($rows > 0) {
                $data = ['status' => 1, 'data' => $result['idusuario'], 'nombre' => $result['Nombre'] , 'token' => $result['token']];
            }else {
                $data = ['status' => 0];
            }
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }

    public function addUsuarios($data) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("INSERT INTO Usuarios(nombre, usuario, contraseña, token) VALUES (:nombre, :usuario, md5(:contraseña), md5(:token))");
            $stmt->bindValue(':nombre', $data['nombre']);
            $stmt->bindValue(':usuario', $data['usuario']);
            $stmt->bindValue(':contraseña', $data['contraseña']);
            $token = $data['nombre'] . '' .$data['contraseña'];
            $stmt->bindValue(':token', $token);
            if($stmt->execute()) {
                $data = ['status' => 1];
            }else {
                $data = ['status' => 0];
            }
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }
}