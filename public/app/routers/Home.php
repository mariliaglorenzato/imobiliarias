<?php
namespace App\Routers;

use App\Application;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Psr7\Response;
use App\Middleware\HeaderMiddleware;

class Home
{
    public $container;

    /** List of available endpoints */
    protected Array $endpoints = [
        'get'
    ];

    public function __construct($container) {
        $this->container = $container;
        $this->get();
    }

    public function get() {
        try {
            // GUsI
            $this->container->app->get('/', function (Request $request, Response $response, $args) {
                return $this->container->renderer->render($response, 'home.html', $args);
            });
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function __destruct() {}
}
?>