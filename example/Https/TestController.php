<?php
namespace Example\Https;

use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class TestController extends HttpController
{

    function get(){
        $this->database->execute("SELECT * FROM tb_app");
        response('Hello word');
    }

    function getHola()
    {
        response('hola');
    }
}