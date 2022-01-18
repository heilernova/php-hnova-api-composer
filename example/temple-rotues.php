<?php

use PhpNv\Routing;

use function PhpNv\Http\response;
header('content-type: application/json');

$route = Routing::get('auth', function(){ response('hola');}, function(){ response('n', 401); });


Routing::get('', function(){ response('hola');}, function(){ response('n', 401); });



response(Routing::getRoutes());