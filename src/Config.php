<?php

declare(strict_types=1);

namespace Engraving\App;

use DI\Definition\Source\DefinitionArray;
use Engraving\Emitter\HttpInteropResponseEmitter;
use Engraving\Emitter\ResponseEmitter;
use Engraving\Pipeline\Pipeline;
use Engraving\Pipeline\QueuePipeline;
use Engraving\Router\FastRouteRouter;
use Engraving\Router\Router;
use Engraving\Template\PlatesRenderer;
use Engraving\Template\Renderer;
use League\Plates\Engine;

use function DI\factory;
use function DI\get;

final class Config extends DefinitionArray
{
    public function __construct()
    {
        parent::__construct([
            ResponseEmitter::class => get(HttpInteropResponseEmitter::class),
            Router::class          => get(FastRouteRouter::class),
            Renderer::class        => get(PlatesRenderer::class),
            Pipeline::class        => get(QueuePipeline::class),
            Engine::class          => factory(PlatesFactory::class),
        ]);
    }
}
