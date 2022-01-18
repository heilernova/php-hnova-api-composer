<?php
namespace App\Http;

use PhpNv\Http\HttpController;

use function PhpNv\Http\response;

class ReportsController extends HttpController
{
    function years(string $nit){
        $sql = "SELECT YEAR(DATE) FROM tb_income_record WHERE business = ? GROUP BY YEAR(date)";

        $restul = $this->database->execute($sql, [$nit])->fetch_all();

        $restul = array_map(function($item){
            return $item[0];
        }, $restul);

        response($restul);
    }

    function get(string $nit, int $year){
        $slq = "SELECT * FROM vi_statement_income WHERE business=? AND YEAR(period)=?";
        $result = $this->database->execute($slq, [$nit, $year])->fetch_all(MYSQLI_ASSOC);
        $result = array_map(function($item){
            $item['incomeRecorted'] = (float)$item['incomeRecorted'];
            $item['incomeExcluded'] = (float)$item['incomeExcluded'];
            $item['incomeExempt'] = (float)$item['incomeExempt'];
            $item['incomeTotal'] = (float)$item['incomeTotal'];
            $item['iva'] = (float)$item['iva'];
            $item['totalRevenue'] = (float)$item['totalRevenue'];
            return $item;
        }, $result);

        response($result);
    }
}