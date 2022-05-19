<?php

declare(strict_types=1);

namespace App;

use App\Presentation\Controllers\OverviewController;
use App\Presentation\Controllers\ThemeParks\ToverlandController;
use App\Presentation\Middleware\RemoveTrailingSlashMiddleware;
use DI\ContainerBuilder;
use Framework\AbstractApplication;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

final class Application extends AbstractApplication
{
    protected function setupDIContainer(ContainerBuilder $builder): void
    {
        // Nothing to see here yet...
    }

    protected function setupApplication(App $app): void
    {
        $this->loadEnvVariables();

        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware(!$this->inProduction, !$this->inProduction, !$this->inProduction);

        $app->add(new RemoveTrailingSlashMiddleware());
    }

    protected function setupRouting(App $app): void
    {
        $apiBaseURL = '/api/v1';

        $app->group($apiBaseURL.'/overview', static function (RouteCollectorProxy $overviewGroup): void
        {
            $overviewGroup->get('/parks', [OverviewController::class, 'displayParksOverview']);
        });

        $app->group($apiBaseURL.'/theme-parks', static function (RouteCollectorProxy $themeParkBaseGroup): void
        {
            $themeParkBaseGroup->group('/toverland', static function (RouteCollectorProxy $park): void
            {
                $park->get('/wait-times', [ToverlandController::class, 'displayWaitTimes']);
            });
        });
    }

    private function loadEnvVariables(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable([__DIR__.'/../../']);
        $dotenv->load();
    }
}
