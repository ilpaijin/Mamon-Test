<?php

/**
 * Smallest API Application of ever
 */

header("Access-Control-Allow-Origin: *");

require_once 'vendor/autoload.php';

use Ilpaijin\Application;
use Ilpaijin\Services;
use Ilpaijin\Domain\Cases\MamonCase;

$container = new Services\Container;
$container->set('mamonCase', new MamonCase());

$app = new Application($container);

$app->run();
