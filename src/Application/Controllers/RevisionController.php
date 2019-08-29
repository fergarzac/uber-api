<?php
declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\UploadedFileInterface;
use App\Application\Models\Vehiculos;
use App\Application\Models\Revisiones;
class RevisionController
{


    public static function allRevisiones(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            if(isset($parsedBody['id']) && !empty($parsedBody['id'])) {
                $revisiones = new Revisiones();
                $response->getBody()->write($revisiones->getRevisiones($parsedBody['id']));
            }else {
                $data = array('status' => 3);
                $payload = json_encode($data);
                $response->getBody()->write($payload);
            }
            
            return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    public static function getRevision(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            if(isset($parsedBody['id']) && !empty($parsedBody['id'])) {
                $revisiones = new Revisiones();
                $response->getBody()->write($revisiones->getRevision($parsedBody['id']));
            }else {
                $data = array('status' => 3);
                $payload = json_encode($data);
                $response->getBody()->write($payload);
            }
            
            return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    public static function getRevisionWeekly(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            if(isset($parsedBody['week']) && !empty($parsedBody['week'])) {
                $revisiones = new Revisiones();
                $response->getBody()->write($revisiones->getRevisionWeek($parsedBody['week'], $parsedBody['id']));
            }else {
                $data = array('status' => 3);
                $payload = json_encode($data);
                $response->getBody()->write($payload);
            }
            
            return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    public static function addRevision(Request $request, Response $response, $args) : Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            $files = $request->getUploadedFiles();
            if(isset($parsedBody['checklist'])) {
                $array = json_decode($parsedBody['checklist']);
                $opciones = '{';
                for($i = 0; $i < sizeof($array) ; $i++) {
                    $opciones .=  '"'. $i . '":' . json_encode($array[$i]) . ($i == sizeof($array) - 1 ? '' : ',');
                }
                $opciones .= '}';

                $opciones = json_encode($opciones);
            }else{
                $opciones = '';
            }
            $data = isset($parsedBody['data']) ? json_decode($parsedBody['data']) : [];


            $json = '{';
            $i = 0;
            foreach ($files as $f => $value) {
                $uploadedFile = $value;
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $directory = __DIR__ . '/../../../public/images';
                    $aux = self::moveUploadedFile($directory, $uploadedFile);
                    $json .=  '"'. $f . '":"' . $aux . ($i++ == sizeof($files) - 1 ? '"' : '",');
                }
            }
            $json .= '}';
            $json = json_encode($json);
            if($opciones != '') {
                $revisiones = new Revisiones();
                $response->getBody()->write($revisiones->addRevisiones($data, $json, $opciones, $parsedBody['idvehiculo']));
            }else {
                $data = array('status' => 3);
                $payload = json_encode($data);
                $response->getBody()->write($payload);
            }

            return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    public static function moveUploadedFile($directory, UploadedFileInterface $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}