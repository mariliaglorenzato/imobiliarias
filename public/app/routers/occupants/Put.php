<?php
namespace App\Routers\Occupants;

use App\Application;
use App\Controllers\ContractsController;
use App\Controllers\OccupantsController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Psr7\Response;
use App\Middleware\HeaderMiddleware;

class Put {

    /**
     * App\Container Class
     */
    protected $container;

    protected OccupantsController $occupantsController;

    public function __construct($container) {
        $this->occupantsController = new OccupantsController($container);
        $this->container = $container;
        $this->template();
        $this->post();
    }

    public function post() {
        try {
            $this->container->app->post('/locatarios/atualizar', function (Request $request, Response $response, $args) {
                $apiResponse = $this->occupantsController->put();
                $response->getBody()->write($apiResponse);
                return $response;
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function template() {
        try {
            $this->container->app->get('/locatarios/editar[/{id}]', function (Request $request, Response $response, $args) {
                if (isset($args['id']))
                    return $this->container->renderer->render($response, 'editarLocatarios.html', $args);
                return $this->container->renderer->render($response, 'listarLocatarios.html', $args);
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
}
?>