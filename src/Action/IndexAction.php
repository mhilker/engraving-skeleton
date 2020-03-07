<?php

declare(strict_types=1);

namespace Engraving\App\Action;

use Engraving\Template\Renderer;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private Renderer $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderer->render('index');

        return new Response(200, ['Content-Type' => 'text/html; charset=UTF-8'], $html);
    }
}
