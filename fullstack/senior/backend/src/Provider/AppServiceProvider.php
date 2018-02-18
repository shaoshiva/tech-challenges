<?php

namespace IWD\JOBINTERVIEW\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class AppServiceProvider.
 *
 * @package IWD\JOBINTERVIEW\Provider
 */
class AppServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
    }

    public function boot(Application $app)
    {
        // CORS
        $app->after(function (Request $request, Response $response) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
        });

        // Status
        $app->get('/', function () use ($app) {
            return 'Status OK';
        });
    }
}
