<?php
namespace App\Http;

use PhpNv\Http\HttpBodyRespose;
use PhpNv\Http\HttpController;
use PhpNv\nv\nv;

use function PhpNv\Http\response;

class UserController extends HttpController
{
    function changePasswordPublic(){
        $body = $this->getBody();
        $password = $body['password'];
        $new_passwrod = $body['newPassword'];
        
        $user = $this->database->execute("SELECT * FROM tb_users")->fetch_assoc();
        $res = new HttpBodyRespose();


        if ($user){
            if (password_verify($password, $user['password'])){
                $new_passwrod = password_hash($new_passwrod, PASSWORD_DEFAULT, ['cos'=>3]);
                $ok = $this->database->query->update(['passwordPublic'=>$new_passwrod], ['id=1'], 'tb_users');

                if ($ok){
                    $this->database->commit();
                    $res->status = true;
                }else{
                    $res->messages[] = "Error de coneción";
                }
            }else{

                $res->messages[] = "Contraseña incorrecta.";
            }
        }else{
            $res->messages[] = "No user";
        }

        response($res);

    }
    
    function changePasswordPrivate(){
        $body = $this->getBody();
        $password = $body['password'];
        $new_passwrod = $body['newPassword'];

        $user = $this->database->execute("SELECT * FROM tb_users")->fetch_assoc();
        
        if ($user){

        }else{

        }

    }
    
    function closeSessions(){

        $token = nv::generateToken();
        $this->database->query->update(['token'=>$token], ['id=1'], 'tb_users');
        $this->database->commit();
        response('ok');
    }
}