<?php

use Example\Guards\User;
use Example\Https\TestController;
use PhpNv\Routing;

use function PhpNv\Http\response;
// Rutas del core
Routing::add('test', TestController::class, function(){ User::autenticate(); });