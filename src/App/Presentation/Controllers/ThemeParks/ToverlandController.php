<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\ThemeParks;

use Psr\Http\Message\ResponseInterface;

final class ToverlandController
{
    public function displayWaitTimes(ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('Toverland wait times here...');

        return $response;
    }
}
