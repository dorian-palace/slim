<?php
require __DIR__ . '/vendor/autoload.php';
require_once('src/Controller/Controller.php');

// use src\Controller;

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

session_start();

// spl_autoload_register(function ($className) {
//     $className = str_replace('App', 'src', $className);
//     $filePath =  str_replace('\\', '/', $className) . '.php';
//     if (file_exists($filePath)) {
//         require($filePath);
//     }
// });

$app = AppFactory::create();

define('BASE_PATH', rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/'));
define('HTTP_HOST', $_SERVER["HTTP_HOST"]);

$app->setBasePath(BASE_PATH);

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->get('/', \src\Controller\controller::class . ':home');

// Add routes
// $app->get('/', function (Request $request, Response $response) {
//     $response->getBody()->write('<a href="/hello/world">Try /hello/world</a>');
//     return $response;
// });


// $app->get('/hello/{name}', function (Request $request, Response $response, $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//     return $response;
// });

$app->run();
