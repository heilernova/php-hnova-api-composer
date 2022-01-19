<?php
namespace Api\Https;

use PhpNv\Routing;


Routing::add('test', TestController::class);
Routing::add('test', Test2Controller::class );
Routing::add('test/{nit:strin}', Test4Controller::class );