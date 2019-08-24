<?php
declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use App\Application\Models\Vehiculos;
class VehiculoController
{

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public static function getVehiculo(Request $request, Response $response, $args): Response
    {
        try {
            
            $parsedBody = $request->getParsedBody();
            if(self::validateId($parsedBody)) {
                $vehiculos = new Vehiculos();
                $payload = $vehiculos->getVehiculo($parsedBody);
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
    public static function allVehiculos(Request $request, Response $response, $args): Response
    {
        try {
            $vehiculos = new Vehiculos();
            $response->getBody()->write($vehiculos->getVehiculos());
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
    public static function addVehiculo(Request $request, Response $response, $args): Response
    {
        try {
            $parsedBody = $request->getParsedBody();
            if(self::validateData($parsedBody)) {
                $vehiculos = new Vehiculos();
                $response->getBody()->write($vehiculos->addVehiculo($parsedBody));
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
        return isset($data['marca']) && !empty($data['marca']) && isset($data['linea']) && !empty($data['linea']) && isset($data['version']) && !empty($data['version']) && isset($data['modelo']) && !empty($data['modelo']) && isset($data['color']) && !empty($data['color']) && isset($data['serie']) && !empty($data['serie']) && isset($data['placas']) && !empty($data['placas']);
    }
}
