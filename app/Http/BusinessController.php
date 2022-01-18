<?php
namespace App\Http;

use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class BusinessController extends HttpController
{

    function get(string $nit = null)
    {
        if ($nit){
            response($this->database->execute("SELECT * FROM tb_business WHERE nit=?", [$nit])->fetch_assoc());
        }else{
            response($this->database->execute("SELECT * FROM tb_business")->fetch_all(MYSQLI_ASSOC));
        }
    }

    function post(){
       
        $ok = $this->database->query->insert($this->getBody(), 'tb_business');
        // response($ok);
        if ($ok){
            $this->database->commit(); response('ok');
        }else{
            response('Error', 400);
        }
    }

    function put(string $nit){
        $parasm = $this->body;

        $ok = $this->database->query->update($parasm, ['nit=?', [$nit]], 'tb_business');

        if ($ok){
            $this->db->commit();
            response('ok');
        }else{
            response('error', 400);
        }
    }

    function delete(string $nit){
        $ok = $this->database->query->delete('nit=?', [$nit], 'tb_business');
        if ($ok){
            $this->database->commit();
            response('ok');
        }else{
            response('error', 400);
        }
    }
}