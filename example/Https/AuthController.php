<?php
namespace Example\Https;

use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class AuthController extends HttpController{

    function autenticate(){
        $data = $this->getBodyJson();

        response($data);
    }
}