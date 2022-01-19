<?php
namespace Api\Https;

use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class Test4Controller extends HttpController
{

	function get(){

		response('ok - get');
	}

	function post(){

		response('ok - post');
	}

	function put(){

		response('ok - put');
	}

	function delete(){

		response('ok - delete');
	}
}