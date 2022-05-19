<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Presentation\DTO\ParksOverviewDTO;
use App\Presentation\Views\ParksOverviewView;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

final class OverviewController
{
    public function displayParksOverview(): ResponseInterface
    {
        $dto = new ParksOverviewDTO();
        $dto->addThemePark('toverland', 'Toverland');

        $view = new ParksOverviewView($dto);
        return $view->asResponse();
    }
}
