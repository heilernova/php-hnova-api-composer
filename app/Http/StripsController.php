<?php
namespace App\Http;

use PhpNv\Http\HttpController;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Thumbnails;

use function PhpNv\Http\response;

class StripsController extends HttpController
{
    function getDays(string $nit, int $year, int $month){
        // response([$nit, $year, $month]);
        $slq = "SELECT * FROM tb_income_record WHERE business=? AND YEAR(date)=? AND MONTH(date)=?";
        // $slq = "SELECT * FROM tb_income_record WHERE business='1007244088' AND YEAR(DATE)=2022 AND MONTH(DATE)=1";
        $resutl = $this->database->execute($slq, [$nit, $year, $month])->fetch_all(MYSQLI_ASSOC);
        $resutl = array_map(function($item){
            $item['incomeRecorted'] = (int)$item['incomeRecorted'];
            $item['iva'] = (int)$item['iva'];
            $item['incomeExcluded'] = (int)$item['incomeExcluded'];
            $item['incomeExempt'] = (int)$item['incomeExempt'];
            return $item;
        }, $resutl);
        response($resutl);
    }

    function post(){
        $data = $this->getBody();

        $sql = "SELECT COUNT(*) FROM tb_income_record WHERE business=? AND date=?";
        $ok = $this->database->execute($sql, [$data['business'], $data['date']])->fetch_array()[0] == 0;

        if ($ok){
            $ok = $this->database->query->insert($data, "tb_income_record");
        }else{
            $ok = $this->database->query->update($data,['business=? AND date=?',[$data['business'], $data['date']]] ,"tb_income_record");
            // response($ok);
        }

        if ($ok){
            $this->database->commit();
            response($ok);

        }else{
            response('error', 400);
        }
    }
}