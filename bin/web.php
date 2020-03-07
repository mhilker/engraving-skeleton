<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Engraving\App\Action\IndexAction;
use Engraving\App\Config;
use Engraving\Application;
use Engraving\Middleware\DispatchMiddleware;
use Engraving\Middleware\ExceptionMiddleware;
use Engraving\Middleware\RoutingMiddleware;
use Engraving\Middleware\WhoopsMiddleware;
use GuzzleHttp\Psr7\ServerRequest;

(static function () {
    require __DIR__ . '/../vendor/autoload.php';

    $request = ServerRequest::fromGlobals();

    $builder = new ContainerBuilder();
    $builder->addDefinitions(new Config());
    $container = $builder->build();

    /** @var Application $application */
    $application = $container->get(Application::class);
    $application->addMiddleware($container->get(ExceptionMiddleware::class));
    $application->addMiddleware($container->get(WhoopsMiddleware::class));
    $application->addMiddleware($container->get(RoutingMiddleware::class));
    $application->addMiddleware($container->get(DispatchMiddleware::class));
    $application->addRoute('GET', '/', $container->get(IndexAction::class));
    $application->run($request);
})();
