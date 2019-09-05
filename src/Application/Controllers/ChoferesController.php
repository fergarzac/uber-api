<?php
declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\UploadedFileInterface;
use App\Application\Models\Choferes;
class ChoferesController
{

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public static function getChofer(Request $request, Response $response, $args): Response
    {
        try {
            
            $parsedBody = $request->getParsedBody();
            if (function_exists('array_key_first')) {
                $json = array_key_first($parsedBody);
            }else{
                $keys = array_keys($parsedBody);
                $json = $keys[0];
            }
            $data_json = json_decode($json, true);
            if(self::validateId($data_json)) {
                $choferes = new Choferes();
                $payload = $choferes->getChofer($data_json);
                $response->getBody()->write($payload);
            }else {
                $data = array('status' => 3, 'data' => $parsedBody);
                $payload = json_encode($data);
                $response->getBody()->write($payload);
            }
            
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
        return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
    }
    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public static function allChoferes(Request $request, Response $response, $args): Response
    {
        try {
            $choferes = new Choferes();
            $response->getBody()->write($choferes->getChoferes());
            return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    public static function buscarChofer(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            if(isset($parsedBody['nombre']) && !empty($parsedBody['nombre'])) {
                $choferes = new Choferes();
                $payload = $choferes->buscar($parsedBody['nombre']);
                $response->getBody()->write($payload);
            }else {
                $data = array('status' => 3, 'data' => $parsedBody);
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

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public static function addChofer1(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            if(self::validateData($parsedBody)) {
                $choferes = new Choferes();
                $response->getBody()->write($choferes->addChofer($parsedBody));
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

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public static function addChofer(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            $files = $request->getUploadedFiles();
            $filecharged = false;
            
            if(self::validateData($parsedBody)) {
                $filename = '';
                if(isset($files['fotoperfil']) && !empty($files['fotoperfil'])){
                    $uploadedFile = $files['fotoperfil'];
                    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                        $directory = __DIR__ . '/../../../public/images';
                        $filename = self::moveUploadedFile($directory, $uploadedFile);
                    }
                }
                $choferes = new Choferes();
                $response->getBody()->write($choferes->addChofer($parsedBody, $filename));
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

    public static function validateId($data) {
        return isset($data['id']) && !empty($data['id']);
    }

    public static function validateData($data) {
        return isset($data['nombre']) && !empty($data['nombre']) && isset($data['direccion']) && !empty($data['direccion']) && isset($data['telefono_1']) && !empty($data['telefono_1']) && isset($data['no_licencia']) && !empty($data['no_licencia']) && isset($data['monto_fianza']) && !empty($data['monto_fianza']) && isset($data['referencia_1']) && !empty($data['referencia_1']) && isset($data['referencia_2']) && !empty($data['referencia_2']) && isset($data['id_uber']) && !empty($data['id_uber']);
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
