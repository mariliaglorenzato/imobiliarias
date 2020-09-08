<?php
namespace App\Routers\Occupants;

use App\Application;
use App\Controllers\ContractsController;
use App\Controllers\OccupantsController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Psr7\Response;
use App\Middleware\HeaderMiddleware;

class Get {

    /**
     * App\Container Class
     */
    protected $container;

    protected OccupantsController $occupantsController;

    public function __construct($container) {
        $this->occupantsController = new OccupantsController($container);
        $this->container = $container;
        $this->template();
        $this->get();
    }


    public function get() {
        try {
            $this->container->app->get('/locatarios/listar', function (Request $request, Response $response, $args) {
                $apiResponse = $this->occupantsController->get();
                $response->getBody()->write($apiResponse);
                return $response;
                            // ->withStatus(201);
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function template() {
        try {
            $this->container->app->get('/locatarios', function (Request $request, Response $response, $args) {
                return $this->container->renderer->render($response, 'listarLocatarios.html', $args);
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function __destruct() {}
}
?>