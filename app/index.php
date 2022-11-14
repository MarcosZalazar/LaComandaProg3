<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr7Middlewares\Middleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require_once  './middlewares/CheckTokenMiddleware.php';
require_once './middlewares/CheckPerfilMiddleware.php';

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';

require_once './controllers/UsuarioController.php';
require_once './controllers/AutenticadorController.php';
require_once './controllers/CriptomonedaController.php';
require_once './controllers/VentaController.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes

$app->group('/usuarios', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UsuarioController::class . ':TraerTodos');
  //$group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
  $group->post('[/]', \UsuarioController::class . ':CargarUno');
  //$group->put('/{id}', \UsuarioController::class . ':ModificarUno');
  //$group->delete('/{id}', \UsuarioController::class . ':BorrarUno');
});

$app->group('/mesas', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UsuarioController::class . ':TraerTodos');
  //$group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
  $group->post('[/]', \UsuarioController::class . ':CargarUno');
  //$group->put('/{id}', \UsuarioController::class . ':ModificarUno');
  //$group->delete('/{id}', \UsuarioController::class . ':BorrarUno');
});

$app->group('/pedidos', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UsuarioController::class . ':TraerTodos');
  //$group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
  $group->post('[/]', \UsuarioController::class . ':CargarUno');
  //$group->put('/{id}', \UsuarioController::class . ':ModificarUno');
  //$group->delete('/{id}', \UsuarioController::class . ':BorrarUno');
});

$app->group('/productos', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UsuarioController::class . ':TraerTodos');
  //$group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
  $group->post('[/]', \UsuarioController::class . ':CargarUno');
  //$group->put('/{id}', \UsuarioController::class . ':ModificarUno');
  //$group->delete('/{id}', \UsuarioController::class . ':BorrarUno');
});


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("Parcial Programacion III - CRIPTOMONEDAS");
    return $response;
});

$app->run();
