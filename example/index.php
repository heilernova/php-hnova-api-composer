<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Example\Https\TestController;
use PhpNv\Main;

$item = "{}";

$item = trim($item, "{\}");

$items = explode(':', $item);

var_dump($items);