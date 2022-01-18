<?php
namespace App\Http;

use PhpNv\Http\HttpController;
use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Date;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends HttpController
{
    function get(string $nit, int $year){        


        $annual_report  = $this->database->execute("SELECT * FROM vi_statement_income WHERE business=? AND YEAR(period)=?", [$nit, $year])->fetch_all(MYSQLI_ASSOC);
        $income_report  = $this->database->execute("SELECT * FROM tb_income_record WHERE business=? AND YEAR(date)=?", [$nit, $year])->fetch_all(MYSQLI_ASSOC);

        $excel = new Spreadsheet();

        $hoja_1 = $excel->getActiveSheet();
        $hoja_1->setTitle('Reporte anual');

        $hoja_1->setCellValue('A1', 'PERIODO');
        $hoja_1->setCellValue('B1', 'Ingresos grabados');
        $hoja_1->setCellValue('C1', 'Ingresos excluidos');
        $hoja_1->setCellValue('D1', 'Ingresos exentos');
        $hoja_1->setCellValue('E1', 'Total ingresos');
        $hoja_1->setCellValue('F1', 'IVA');
        $hoja_1->setCellValue('G1', 'Total recaudo');

        $i=1;

        foreach($annual_report as $item){
            $i++;
            $hoja_1->setCellValue("A$i", SharedDate::PHPToExcel($item['period'])); //$item['period';
            $hoja_1->setCellValue("B$i", $item['incomeRecorted']);
            $hoja_1->setCellValue("C$i", $item['incomeExcluded']);
            $hoja_1->setCellValue("D$i", $item['incomeExempt']);
            $hoja_1->setCellValue("E$i", $item['incomeTotal']);
            $hoja_1->setCellValue("F$i", $item['iva']);
            $hoja_1->setCellValue("G$i", $item['totalRevenue']);
        }
        
        $hoja_1->getStyle("B2:G$i")->getNumberFormat()->setFormatCode('#,###.00');
        $hoja_1->getStyle("A2:A$i")->getNumberFormat()->setFormatCode('yyyy-mmm');
        $hoja_1->getColumnDimension('A')->setAutoSize(true);
        $hoja_1->getColumnDimension('B')->setAutoSize(true);
        $hoja_1->getColumnDimension('C')->setAutoSize(true);
        $hoja_1->getColumnDimension('D')->setAutoSize(true);
        $hoja_1->getColumnDimension('E')->setAutoSize(true);
        $hoja_1->getColumnDimension('F')->setAutoSize(true);
        $hoja_1->getColumnDimension('G')->setAutoSize(true);

        
        
        $hoja_2 = new Worksheet();
        $hoja_2->setTitle('Regsistros del año');
        
        $hoja_2 = $excel->addSheet($hoja_2);
        
        $hoja_2->setCellValue('A1', 'id');
        $hoja_2->setCellValue('B1', 'Fecha');
        $hoja_2->setCellValue('C1', 'Ingresos grabados');        
        $hoja_2->setCellValue('D1', 'IVA');        
        $hoja_2->setCellValue('E1', 'Ingresos excluidos');        
        $hoja_2->setCellValue('F1', 'Ingresos exentos');

        $i=1;
        foreach ($income_report as $item){
            $i++;
            $hoja_2->setCellValue("A$i", $item['id']);
            $hoja_2->setCellValue("B$i",  SharedDate::PHPToExcel($item['date']));
            $hoja_2->setCellValue("C$i", $item['incomeRecorted']);
            $hoja_2->setCellValue("D$i", $item['iva']);
            $hoja_2->setCellValue("E$i", $item['incomeExcluded']);
            $hoja_2->setCellValue("F$i", $item['incomeExempt']);
        }

        $hoja_2->getStyle("C2:F$i")->getNumberFormat()->setFormatCode('#,##0.00');
        // $hoja_2->getStyle("A2:A$i")->getNumberFormat()->setFormatCode('dd-mm-yyyy');

        $hoja_2->getColumnDimension('A')->setAutoSize(true);
        $hoja_2->getColumnDimension('B')->setAutoSize(true);
        $hoja_2->getColumnDimension('C')->setAutoSize(true);
        $hoja_2->getColumnDimension('D')->setAutoSize(true);
        $hoja_2->getColumnDimension('E')->setAutoSize(true);
        $hoja_2->getColumnDimension('F')->setAutoSize(true);




        
        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte-ingresos.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
        exit();

    }
}