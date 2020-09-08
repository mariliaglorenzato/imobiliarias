<?php
namespace App;

use \Slim\Factory\AppFactory;
use App\Exceptions\ApplicationException;
use App\Routers\Router;
use App\Controllers\BaseController;

class Application
{
    /**
     * Container Class
     */
    protected Container $container;

    /**
     * Router Class (Map Application endpoints)
     */
    protected Router $router;

    /**
     * Controller Class
     */
    protected BaseController $controller;

    /**
     * Constructor Class
     */
    public function __construct() {
        $this->container = new Container();
        $this->router = new Router($this->container);
        $this->container->app->run();
    }
}