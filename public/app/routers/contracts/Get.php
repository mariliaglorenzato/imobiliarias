<?php
namespace App\Routers\Contracts;

use App\Application;
use App\Controllers\ContractsController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Psr7\Response;
use App\Middleware\HeaderMiddleware;

class Get {

    /**
     * App\Container Class
     */
    protected $container;

    protected ContractsController $contractsController;

    public function __construct($container) {
        $this->contractsController = new ContractsController($container);
        $this->container = $container;
        $this->get();
    }

    public function get() {
        try {
            $this->container->app->get('/contratos/listar', function (Request $request, Response $response, $args) {
                $apiResponse = $this->contractsController->get($_GET['id'] ?? null);
                // var_dump($apiResponse);exit;
                $response->getBody()->write($apiResponse);
                return $response;
                            // ->withStatus(201);
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function __destruct() {}
}
?>