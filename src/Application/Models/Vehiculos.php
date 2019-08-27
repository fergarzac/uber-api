<?php
namespace App\Application\Models;

use App\Application\Util\Conexion;

class Vehiculos {
    protected $con;
    public function __construct()
    {
        $this->con = Conexion::getInstance();
    }

    public function getVehiculos() {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Vehiculo");
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

    public function getVehiculo($data) {
        try {
            $id = $data['id'];
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM Vehiculo WHERE idvehiculo = :id");
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

    public function addVehiculo($data, $filenames = []) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("INSERT INTO Vehiculo(marca, linea, version, modelo, color, serie, placas, pedimento, tarjeta_circulacion, seguro, factura, idchofer) 
            VALUES (:marca, :linea, :version, :modelo, :color, :serie, :placas,:pedimento, :tarjeta, :seguro, :factura, 0)");
            $stmt->bindValue(':marca', $data['marca'], \PDO::PARAM_STR);
            $stmt->bindValue(':linea', $data['linea'], \PDO::PARAM_STR);
            $stmt->bindValue(':version', $data['version'], \PDO::PARAM_STR);
            $stmt->bindValue(':modelo', $data['modelo'], \PDO::PARAM_STR);
            $stmt->bindValue(':color', $data['color'], \PDO::PARAM_STR);
            $stmt->bindValue(':serie', $data['serie'], \PDO::PARAM_STR);
            $stmt->bindValue(':placas', $data['placas'], \PDO::PARAM_STR);
            $stmt->bindValue(':pedimento', isset($filenames['pedimento']) ? $filenames['pedimento']: '', \PDO::PARAM_STR);
            $stmt->bindValue(':tarjeta', isset($filenames['tarjeta']) ? $filenames['tarjeta']: '', \PDO::PARAM_STR);
            $stmt->bindValue(':seguro', isset($filenames['seguro']) ? $filenames['seguro']: '', \PDO::PARAM_STR);
            $stmt->bindValue(':factura', isset($filenames['factura']) ? $filenames['factura']: '', \PDO::PARAM_STR);
            if($stmt->execute()) {
                $data = ['status' => 1, 'files' => $filenames];
            }else {
                $data = ['status' => 0, 'files' => $filenames];
            }
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }
}