<?php
namespace App\Routers;
use App\Routers\Home;
use App\Routers\Contracts\Get as ListContracts;
use App\Routers\Occupants\Create as CreateOccupant;
use App\Routers\Occupants\Put as PutOccupant;
use App\Routers\Occupants\Get as GetOccupant;
use App\Routers\Properties\Create as CreateProperty;
/**
 * Routes Manager
 */
class Router
{

    public $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->loadRoutes();
    }

    public function __destruct() {}

    protected function loadRoutes() {
        try {
            new Home($this->container);
            new ListContracts($this->container);
            new CreateOccupant($this->container);
            new PutOccupant($this->container);
            new GetOccupant($this->container);
            new CreateProperty($this->container);

        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
}
?>