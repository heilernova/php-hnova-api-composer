<?php
use PhpNv\Main;

require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../app/app-routes.php";

$main = new Main('../app/settings.json');
$main->setOrigin('*');
// $main->setHeaders('*');
$main->run($_GET['url']);