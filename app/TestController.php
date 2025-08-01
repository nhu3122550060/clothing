<?php

declare(strict_types=1);

namespace App;

use Tempest\Router\Get;
use Tempest\Http\Response;

use function Tempest\response;

final class TestController
{
    #[Get('/test')]
    public function __invoke(): Response
    {
        return response('Hello World! This is a test.');
    }
}
