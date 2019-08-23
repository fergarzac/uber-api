<?php
declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use App\Application\Models\Usuarios;
class UsuariosController
{

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public static function login(Request $request, Response $response, $args): Response
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
            if(self::validateDataLogin($data_json)) {
                $usuarios = new Usuarios();
                $payload = $usuarios->getUser($data_json);
                
                $response->getBody()->write($payload);
            }else {
                $data = array('status' => 3, 'data' => $data_json);
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
    public static function allUsers(Request $request, Response $response, $args): Response
    {
        try {
            $usuarios = new Usuarios();
            $response->getBody()->write($usuarios->getUsuarios());
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
    public static function addUser(Request $request, Response $response, $args): Response
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
            if(self::validateData($data_json)) {
                $usuarios = new Usuarios();
                $response->getBody()->write($usuarios->addUsuarios($data_json));
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

    public static function validateDataLogin($data) {
        return isset($data['usuario']) && !empty($data['usuario']) && isset($data['contraseña']) && !empty($data['contraseña']);
    }
    public static function validateData($data) {
        return isset($data['nombre']) && !empty($data['nombre']) && isset($data['usuario']) && !empty($data['usuario']) && isset($data['contraseña']) && !empty($data['contraseña']);
    }
}
