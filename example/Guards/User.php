<?php
namespace Example\Guards;

use function PhpNv\Http\response;

class User{
    public static function autenticate(){
        response('', 401);
    }
}