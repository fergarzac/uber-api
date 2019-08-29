<?php
namespace App\Application\Models;

use App\Application\Util\Conexion;

class Revisiones {
    protected $con;
    public function __construct()
    {
        $this->con = Conexion::getInstance();
    }

    public function getRevisiones($id) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM revision WHERE idvehiculo = :id");
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
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

    public function getRevision($id) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM revision WHERE idrevision = :id");
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
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

    public function getRevisionWeek($week, $id) {
        try {
            $pdo = $this->con->getConnection();
            $data = explode('-', $week);
            $year = $data[0];
            $week = str_replace('W', '', $data[1]);
            $stmt = $pdo->prepare("SELECT * FROM revision WHERE WEEK(semana, 1) = :week AND YEAR(semana) = :year AND idvehiculo = :id");
            $stmt->bindValue(':week', $week, \PDO::PARAM_STR); 
            $stmt->bindValue(':year', $year, \PDO::PARAM_STR); 
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR); 
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

    public function addRevisiones($data, $imagenes, $opciones, $id) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("INSERT INTO revision(kilometraje, incentivos, ganancias, efectivo, horas_conectado, deposito_bancario, renta, pendientes, multas, choques, total, pendiente, rutas_imagenes, opciones, idvehiculo) 
                                    VALUES (:kilometraje, :incentivos, :ganancias, :efectivo, :horas_conectado, :deposito_bancario, :renta, :pendientes, :multas, :choques, :total, :pendiente, $imagenes, $opciones, $id)");
            $stmt->bindParam(':kilometraje', $data->kilometraje);
            $stmt->bindParam(':incentivos', $data->incentivos);
            $stmt->bindParam(':ganancias', $data->ganancias_totales);
            $stmt->bindParam(':efectivo', $data->efectivo);
            $stmt->bindParam(':horas_conectado', $data->horas_conectado);
            $stmt->bindParam(':deposito_bancario', $data->depositos_bancarios);
            $stmt->bindParam(':renta', $data->renta);
            $stmt->bindParam(':pendientes', $data->pendientes);
            $stmt->bindParam(':multas', $data->multas);
            $stmt->bindParam(':choques', $data->choques);
            $stmt->bindParam(':total', $data->total);
            $stmt->bindParam(':pendiente', $data->pendiente);
            if($stmt->execute()) {
                $data = ['status' => 1];
            }else {
                $data = ['status' => 0, 'error' => $stmt->errorInfo()];
            }
            
        }catch(\PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }
}