<?php
namespace App\Http;

use PhpNv\Http\HttpBodyRespose;
use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class AuthController extends HttpController
{
    function authenticate(){
        $data = $this->getBody();
        
        $user = $data['user'];
        $password = $data['password'];

        $user = $this->database->execute("SELECT * FROM tb_users WHERE userName=?",[$user])->fetch_assoc();
        $res = new HttpBodyRespose();

        if ($user){

            if (password_verify($password, $user['passwordPublic']) || password_verify($password, $user['password'])){
                $res->data = $user['token'];
                $res->status = true;
            }else{
                $res->messages[] = "Contraseña incorrecta";
            }
        }else{
            $res->messages[] = "Usuario erroneo";
        }

        response($res);
    }
}