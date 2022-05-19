<?php

declare(strict_types=1);

namespace App\Presentation\Views;

use App\Presentation\Layouts\JSONResponseLayout;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

abstract class AbstractJSONView
{
    public function asResponse(): ResponseInterface
    {
        $pageLayout = new JSONResponseLayout($this->getViewData());

        $response = new Response();
        $response = $response->withHeader('Content-Type', 'application/json');

        $response->getBody()->write($pageLayout->toJSON());

        return $response;
    }

    /**
     * @return array<mixed>
     */
    abstract protected function getViewData(): array;
}
