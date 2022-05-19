<?php

declare(strict_types=1);

namespace Framework;

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Slim\App;

abstract class AbstractApplication
{
    protected bool $inProduction = false;

    private ?App $slimApp = null;
    private ?Container $dependencyContainer = null;

    public function __construct()
    {
        $this->dependencyContainer = $this->createDependencyContainer();
        $this->slimApp = $this->createSlimpApp();

        $this->setupApplication($this->slimApp);
        $this->setupRouting($this->slimApp);
    }

    public function inProduction(bool $state): void
    {
        $this->inProduction = $state;
    }

    public function run(): void
    {
        $this->slimApp->run();
    }

    abstract protected function setupDIContainer(ContainerBuilder $builder): void;
    abstract protected function setupApplication(App $app): void;
    abstract protected function setupRouting(App $app): void;

    private function createSlimpApp(): App
    {
        return Bridge::create($this->dependencyContainer);
    }

    private function createDependencyContainer(): Container
    {
        $builder = new ContainerBuilder();

        $builder->useAnnotations(false);
        $builder->useAutowiring(true);

        $this->setupDIContainer($builder);

        return $builder->build();
    }
}
