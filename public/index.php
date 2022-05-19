<?php

declare(strict_types=1);

use App\Application;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app->inProduction(false);
$app->run();
