<?php

declare(strict_types=1);

namespace Engraving\App;

use League\Plates\Engine;

final class PlatesFactory
{
    public function __invoke(): Engine
    {
        return new Engine(__DIR__ . '/../view/', 'phtml');
    }
}
