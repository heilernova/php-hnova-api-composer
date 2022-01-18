<?php
namespace Example\Https;

use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class TestController extends HttpController
{

    function get(){
        $result = $this->database->execute("SELECT * FROM tb_business")->fetch_all(MYSQLI_ASSOC);
        response($result);
    }

    function getHola()
    {
        response('hola');
    }
}