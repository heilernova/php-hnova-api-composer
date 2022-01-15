<?php

use PhpNv\Error;
use PhpNv\Main;
use PhpNv\Routes\Route;

require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../example/routes.php";

$main = new Main('../example/settings.json');
$main->setOrigin('*');
$main->run($_GET['url']);