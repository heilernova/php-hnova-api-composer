<?php
namespace PhpNv\Http;

use PhpNv\Data\Database;

use function PhpNv\Data\nv_database_init;

class HttpController
{
    public Database $database;

    public function __construct()
    {
        $this->database = nv_database_init();
    }
}