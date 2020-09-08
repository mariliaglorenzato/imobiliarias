<?php
namespace App\Controllers;
use GuzzleHttp\Client;


class BaseController {

    protected $container;

    protected Array $header;

    function __construct($container) {
        $this->container = $container;
    }

}
?>