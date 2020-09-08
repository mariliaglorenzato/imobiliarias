<?php
namespace App;

use \Slim\Factory\AppFactory;
use \Slim\Views\Twig;
use \GuzzleHttp\Client;
use App\Exceptions\ApplicationException;
use Slim\Views\PhpRenderer;


class Container
{
    /**
     * \Slim\Factory\AppFactoy object
     */
    public $app;

    /**
     * GuzzleHTTP Client to connect to Imobiliarias API
     */
    public Client $client;

    /**
     * Render Template HTML views
     */
    public PhpRenderer $renderer;

    /**
     * Imobiliarias API credentials
     */
    protected Array $credentials = [];

    public function __construct() {
        $this->credentials = $this->retrieveCredentials();
        $this->client = $this->connectApiImobiliarias();
        $this->app = $this->init();
        $this->renderer = $this->loadViewerRenderer();
    }

    protected function retrieveCredentials() {
        try {
            $cred = parse_ini_file(__DIR__. "/../../settings.ini");
            if (!isset($cred['appToken'])) throw new ApplicationException("Missing App Token");
            if (!isset($cred['accessToken'])) throw new ApplicationException("Missing Access Token");
            if (!isset($cred['uri'])) throw new ApplicationException("Missing Uri");
            return [
                'appToken'    => $cred['appToken'],
                'accessToken' => $cred['accessToken'],
                'base_uri'    => $cred['uri']
            ];
        } catch(\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    protected function init() {
        return AppFactory::create();
    }

    public function connectApiImobiliarias() {
        return new Client([
            'base_uri'  => $this->credentials['base_uri'],
            'headers'   => [
                'Content-Type'  => 'application/json',
                'app_token'     => $this->credentials['appToken'],
                'access_token'  => $this->credentials['accessToken']
            ],
        ]);
    }

    public function getCredentials() {
        return $this->credentials;
    }

    public function loadViewerRenderer() {
        $parts = explode("/", __DIR__);
        $lastIndex = count($parts) - 1;
        $dir = str_replace($parts[$lastIndex], "", __DIR__);
        $templatesDirectory = $dir . 'templates';
        return new PhpRenderer($templatesDirectory);
    }
}