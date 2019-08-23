<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Controllers\UsuariosController;
use App\Application\Controllers\VehiculoController;
use App\Application\Controllers\ChoferesController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Middleware\SessionMiddleware;
use App\Application\Middleware\CorsEnabled;
return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    })->add(SessionMiddleware::class);


    $app->group('/users/', function (Group $group) use ($container) {
        $group->get('all', UsuariosController::class . '::allUsers');
        $group->post('login', UsuariosController::class . '::login');
        $group->post('add', UsuariosController::class . '::addUser');
    })->add(CorsEnabled::class);

    $app->group('/vehiculos/', function (Group $group) use ($container) {
        $group->get('all', VehiculoController::class . '::allVehiculos');
        $group->post('id', VehiculoController::class . '::getVehiculo');
        $group->post('add', VehiculoController::class . '::addVehiculo');
    })->add(CorsEnabled::class);

    $app->group('/choferes/', function (Group $group) use ($container) {
        $group->get('all', ChoferesController::class . '::allChoferes');
        $group->post('id', ChoferesController::class . '::getChofer');
        $group->post('add', ChoferesController::class . '::addChofer');
    })->add(CorsEnabled::class);
};
