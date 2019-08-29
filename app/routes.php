<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Controllers\UsuariosController;
use App\Application\Controllers\VehiculoController;
use App\Application\Controllers\ChoferesController;
use App\Application\Controllers\RevisionController;
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

    $app->get('/img[/[{data}]]', function (Request $request, Response $response, $args) {
        $data = isset($args['data']) ? $args['data'] : '';
        if(empty($data)) {
            $response->getBody()->write('Hello world!');
            return $response;
        }else {
            $directory = __DIR__ . '\\..\\public\\images\\'.$data;
            $extensiones = ['jpg', 'gif', 'png', 'jpeg'];
            $resourceFound = false;
            $ext = '';
            try {
                foreach($extensiones as $ex => $val) {
                    $file_handle = @fopen($directory . '.' . $val ,"r");
                    if ($file_handle) {
                        $ext = $val;
                        $resourceFound = true;
                        break;
                    }
                }
                if (!$resourceFound) {
                    throw new Exception('Failed to open uploaded file');
                }else {
                    $image = file_get_contents($directory . '.' . $ext);
                    $response->getBody()->write($image);
                    return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE);
                }
            }catch(Exception $e) {
                $response->getBody()->write($e->getMessage());
                return $response;
            }
        }
        
    })->add(CorsEnabled::class);

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

    $app->group('/revisiones/', function (Group $group) use ($container) {
        $group->post('all', RevisionController::class . '::allRevisiones');
        $group->post('id', RevisionController::class . '::getRevision');
        $group->post('week', RevisionController::class . '::getRevisionWeekly');
        $group->post('add', RevisionController::class . '::addRevision');
    })->add(CorsEnabled::class);
};
