<?php
namespace PhpNv\nv;

use PhpNv\Data\Database;

use function PhpNv\Data\nv_database_init;

class nv{


    public static function generateToken(int $long = 50){
        if ($long < 4) $long = 4;
 
        return bin2hex(random_bytes(($long - ($long % 2)) / 2));
    }

    public static function getDatabase():Database{
        return nv_database_init();
    }
}