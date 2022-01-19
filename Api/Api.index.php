<?php
// Archivo de ejecucion de la aplicacion

// requirimo el archivo autoload
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'Api.ruter.php';


$main = new PhpNv\Main(__DIR__ . '/Api.settings.json');
$main->run($_GET["url"]);