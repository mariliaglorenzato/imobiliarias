<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__  . '/Autoloader.php';
require_once __DIR__  . '/app/Application.php';

use App\Application;

try {
    $autoloader = new Autoloader();
    $app = new Application();
} catch (\Exception $ex) {
    exit;
    var_dump($ex->getMessage());exit;
}

// /**
//  * Add Middleware On Route
//  */

// // Add Middleware On Group
// //$app->group('/', function () { ... })->add(new ExampleMiddleware());

// $app->get('/foo', function (Request $request, Response $response, array $args) {
//     $payload = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);
//     $response->getBody()->write($payload);
//     return $response->withHeader('Content-Type', 'application/json');
// });

// $app->run();
