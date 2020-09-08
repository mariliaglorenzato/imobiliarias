<?php
namespace App\Routers\Properties;

use App\Application;
use App\Controllers\ContractsController;
use App\Controllers\OccupantsController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Psr7\Response;
use App\Middleware\HeaderMiddleware;

class Create {

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

    public function template() {
        try {
            $this->container->app->get('/imoveis/cadastrar', function (Request $request, Response $response, $args) {
                return $this->container->renderer->render($response, 'cadastrarImovel.html', $args);
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function post() {
        try {
            $this->container->app->post('/imoveis/salvar', function (Request $request, Response $response, $args) {
                $apiResponse = $this->occupantsController->post();
                $response->getBody()->write($apiResponse);
                return $response;
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function __destruct() {}
}
?>