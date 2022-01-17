<?php
use Example\Https\TestController;
use PhpNv\Routing;

use function PhpNv\Http\response;
// Rutas del core
Routing::AddRoute('test', TestController::class, null);