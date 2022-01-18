<?php
namespace App;

use function PhpNv\Data\nv_database_init;
use function PhpNv\Http\response;

class Guard
{
    public static function autenticate(){


        $headers = apache_request_headers();
        // response($headers);
        if (array_key_exists('ftc-token', $headers)){
            $db = nv_database_init();
            $token = $headers['ftc-token'];
            $ok = $db->execute("SELECT COUNT(*) FROM tb_users WHERE token=?", [$token])->fetch_array()[0];
            if ($ok == 0){

                response('no access', 401);
            }
        }else{
            response('no access', 401);
        }

    }
}