<?php

use App\Guard;
use App\Http\AuthController;
use App\Http\BusinessController;
use App\Http\ExportController;
use App\Http\ReportsController;
use App\Http\StripsController;
use App\Http\UserController;
use PhpNv\Routing;

use function PhpNv\Http\response;


Routing::post('auth', [AuthController::class, 'authenticate']);

Routing::add('business',BusinessController::class, function(){ Guard::autenticate(); });
Routing::add('business/{nit:string}',BusinessController::class, function(){ Guard::autenticate(); });

Routing::add('strips', StripsController::class, function(){ Guard::autenticate(); });
Routing::add('strips/{id:int}', StripsController::class, function(){ Guard::autenticate(); });
Routing::get('strips/regiter-month/{nit:string}/{year:int}/{month:int}', [StripsController::class, 'getDays'], function(){ Guard::autenticate(); });

Routing::get('report/{nit:string}/years', [ReportsController::class, 'years'], function(){ Guard::autenticate(); });
Routing::get('report/{nit:string}/{year:int}', [ReportsController::class], function(){ Guard::autenticate(); });

Routing::get('export/{nit:string}/{year:int}', [ExportController::class, 'get'],  function(){ Guard::autenticate(); });

Routing::post('user/close-sessions', [UserController::class, 'closeSessions'], function(){ Guard::autenticate(); });
Routing::post('user/change-password-public', [UserController::class, 'changePasswordPublic'], function(){ Guard::autenticate(); });