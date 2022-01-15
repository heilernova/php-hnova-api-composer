<?php
use Example\Https\TestController;
use PhpNv\Data\ObjectRow;
use PhpNv\Routes\Route;
use PhpNv\Routing;

// Rutas del core
Routing::AddRoute('test', TestController::class, null);
Routing::AddRoute('test/hola', [TestController::class, 'hola'], null);
Routing::AddRoute('core/test', function(){ echo "Hola"; }, null);