<?php
namespace App\Application\Models;

use App\Application\Util\Conexion;

class Choferes {
    protected $con;
    public function __construct()
    {
        $this->con = Conexion::getInstance();
    }

    public function getChoferes() {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Choferes");
            $stmt->execute();
            $data = [];
            while ($fila = $stmt->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_NEXT)) {
                array_push($data, $fila);
            }
        }catch(PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }

    public function buscar($nombre) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Choferes WHERE nombre LIKE :nombre AND (SELECT idvehiculo FROM vehiculo WHERE idchofer = choferes.idchofer) IS NOT NULL");
            $stmt->bindValue(':nombre','%'. $nombre.'%', \PDO::PARAM_STR);
            $stmt->execute();
            $data = [];
            while ($fila = $stmt->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_NEXT)) {
                array_push($data, $fila);
            }
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }

    public function getChofer($data) {
        try {
            $id = $data['id'];
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Choferes WHERE idchofer = :id");
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $rows = $stmt->rowCount();
            if($rows > 0) {
                $data = ['status' => 1, 'data' => $result];
            }else {
                $data = ['status' => 0];
            }
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }

    public function addChofer($data, $imagen = '') {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("INSERT INTO Choferes(nombre, direccion, telefono_1, telefono_2, no_licencia, monto_fianza, referencia_1, referencia_2, id_uber, foto_id) 
                                    VALUES (:nombre, :direccion, :telefono_1, :telefono_2, :no_licencia, :monto_fianza, :referencia_1, :referencia_2, :id_uber, :foto_id)");
            $stmt->bindValue(':nombre', $data['nombre'], \PDO::PARAM_STR);
            $stmt->bindValue(':direccion', $data['direccion'], \PDO::PARAM_STR);
            $stmt->bindValue(':telefono_1', $data['telefono_1'], \PDO::PARAM_STR);
            $stmt->bindValue(':telefono_2', $data['telefono_2'], \PDO::PARAM_STR);
            $stmt->bindValue(':no_licencia', $data['no_licencia'], \PDO::PARAM_STR);
            $stmt->bindValue(':monto_fianza', $data['monto_fianza'], \PDO::PARAM_STR);
            $stmt->bindValue(':referencia_1', $data['referencia_1'], \PDO::PARAM_STR);
            $stmt->bindValue(':referencia_2', $data['referencia_2'], \PDO::PARAM_STR);
            $stmt->bindValue(':id_uber', $data['id_uber'], \PDO::PARAM_STR);
            $stmt->bindValue(':foto_id', $imagen, \PDO::PARAM_STR);
            if($stmt->execute()) {
                $data = ['status' => 1, 'img' => $imagen];
            }else {
                $data = ['status' => 0, 'error' => $stmt->errorInfo(), 'img' => $imagen];
            }
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }
}