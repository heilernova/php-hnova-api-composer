<?php
namespace PhpNv\Http;

function response($content_body, $response_code = 200){
    echo json_encode($content_body);
    http_response_code($response_code);
    exit;
}