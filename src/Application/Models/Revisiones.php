<?php
namespace App\Application\Models;

use App\Application\Util\Conexion;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

    public function getIngresos($mes, $id = '') {
        try { 
            $pdo = $this->con->getConnection();

            $stmt = $pdo->prepare("SELECT SUM(ganancias) as ganancias FROM revision WHERE MONTH(semana) = :mes " . ($id != '' ? "AND id = '$id'" : ''));
            $stmt->bindValue(':mes', $mes, \PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);;
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
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);;
        }catch(PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return json_encode($data);
    }
    public function getRevisionChofer($id, $mes) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT idrevision, semana, rutas_imagenes, opciones  FROM revision WHERE idvehiculo = (SELECT idvehiculo FROM vehiculo WHERE idchofer = :id) " . ($mes != '' ? "AND  MONTH(semana) = '$mes'" : ''));
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
            $stmt->execute();
            $data = [];
            while ($fila = $stmt->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_NEXT)) {
                array_push($data, $fila);
            }
        }catch(PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        $res = [];
        if(sizeof($data)>0 && !isset($data['status'])) {
            $res = array('info' => $data, 'metricas' => $this->getMetricasChofer($id, $mes));
        }
        return json_encode($res);
    }

    public function getMetricasChofer($id, $mes) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT SUM(ganancias) as ganancias, SUM(kilometraje) as kilometraje, SUM(incentivos) as incentivos, SUM(efectivo) as efectivo, SUM(horas_conectado) as horas_conectado, SUM(deposito_bancario) as deposito_bancario, SUM(renta) as renta, SUM(pendientes) as pendientes, SUM(choques) as choques, SUM(multas) as multas, SUM(total) as total, SUM(pendiente) as pendiente  FROM revision WHERE idvehiculo = (SELECT idvehiculo FROM vehiculo WHERE idchofer = :id) " . ($mes != '' ? "AND  MONTH(semana) = '$mes'" : ''));
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);;
        }catch(PDOException $e) {
            $data = ['status' => 0, 'error' => $e->getMessage()];
        }
        return $data;
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

    public function downloadReporte($id) {
        try {
            $pdo = $this->con->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM revision WHERE idrevision = :id");
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            $id = $id .'-'. $data['idvehiculo'].'-'.$data['semana'];
            $report = $this->generateExcel($id, $data);
            $data = json_decode($data['rutas_imagenes']);
            $res = $this->createZip($data, $id);
        }catch(PDOException $e) {
            $res = ['status' => 0, 'error' => $e->getMessage()];
        }catch(Exception $e) {
            $res = ['status' => 0, 'error' => $e->getMessage()];
        }
        return $res;
    }

    public function createZip($imagenes, $id) {
        $directory = __DIR__ . '/../../../public/';
        $zip = new \ZipArchive;
        if ($zip->open('reportes/'.$id.'.zip', \ZipArchive::CREATE) === TRUE)
        {
            foreach($imagenes as $d => $v) {
                $download_file = file_get_contents($directory.'images/'.$v);
                
                $zip->addFromString($d . '.' . explode('.', $v)[1] ,$download_file);
            }
            $excel = file_get_contents($directory.'excel/'.$id.'.xlsx');
            $zip->addFromString('Reporte.xlsx' ,$excel);
            // All files are added, so close the zip file.
            $zip->close();
            return array('status' => 1, 'ruta' => __DIR__ . '/../../../public/reportes/'.$id.'.zip', 'name' => $id.'.zip');
        }
        return array('status' => 0);
    }

    public function generateExcel($id, $data = []) {
        $directory = __DIR__ . '/../../../public/excel';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Kilometraje');
        $sheet->setCellValue('C1', 'Incentivos');
        $sheet->setCellValue('D1', 'Ganancias');
        $sheet->setCellValue('E1', 'Efectivo');
        $sheet->setCellValue('F1', 'Horas Conectado');
        $sheet->setCellValue('G1', 'Depositos bancarios');
        $sheet->setCellValue('H1', 'Renta');
        $sheet->setCellValue('I1', 'Pendientes');
        $sheet->setCellValue('J1', 'Multas');
        $sheet->setCellValue('K1', 'Choques');
        $sheet->setCellValue('L1', 'Total');
        $sheet->setCellValue('M1', 'Pendiente');

        $sheet->setCellValue('A2', $data['semana']);
        $sheet->setCellValue('B2', $data['kilometraje']);
        $sheet->setCellValue('C2', $data['incentivos']);
        $sheet->setCellValue('D2', $data['ganancias']);
        $sheet->setCellValue('E2', $data['efectivo']);
        $sheet->setCellValue('F2', $data['horas_conectado']);
        $sheet->setCellValue('G2', $data['deposito_bancario']);
        $sheet->setCellValue('H2', $data['renta']);
        $sheet->setCellValue('I2', $data['pendientes']);
        $sheet->setCellValue('J2', $data['multas']);
        $sheet->setCellValue('K2', $data['choques']);
        $sheet->setCellValue('L2', $data['total']);
        $sheet->setCellValue('M2', $data['pendiente']);

        $sheet->setCellValue('A4', 'Ganancias');
        $sheet->setCellValue('A5', 'Efectivo');
        $sheet->setCellValue('A6', 'Horas Conectado');
        $sheet->setCellValue('A7', 'Depositos bancarios');
        $sheet->setCellValue('A8', 'Renta');
        $sheet->setCellValue('A9', 'Pendientes');
        $sheet->setCellValue('A10', 'Multas');
        $sheet->setCellValue('A11', 'Choques');
        $sheet->setCellValue('A12', 'Total');
        $sheet->setCellValue('A13', 'Pendiente');
        $writer = new Xlsx($spreadsheet);
        $writer->save($directory . '/'. $id .'.xlsx');
    }
}