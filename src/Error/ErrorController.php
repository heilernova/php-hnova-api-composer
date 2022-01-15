<?php
namespace PhpNv\Error;

use function PhpNv\Http\response;

class ErrorController
{
    public static function get()
    {
        $dir = $_ENV['nv-api-dir-errors'];
        $text = '[' . trim(file_get_contents($dir . 'system-errors.txt'), ",\n") . ']';
        response(json_decode($text));
    }
}
