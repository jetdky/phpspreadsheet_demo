<?php
namespace DengExcel;

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

//IOFactory 自动判断格式实例化对应的类
class DengExcel
{
    public function read($path)
    {
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        return $sheet;
    }

    /**
     * 存储信息到excel
     *
     * @param array $data
     * @param array $title
     * @return void
     */
    function save($data, $title, $name)
    {

        // $data = [
        //     ['1' => '111', '2' => '222'],
        //     ['1' => '111', '2' => '222'],
        //     ['1' => '111', '2' => '222']
        // ];
        // $title = ['第一行标题', '第二行标题'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //表头
        //设置单元格内容
        $titCol = 'A';
        foreach ($title as $value) {
            // 单元格内容写入
            $sheet->setCellValue($titCol . '1', $value);
            $titCol++;
        }

        $row = 2; // 从第二行开始
        foreach ($data as $item) {
            $dataCol = 'A';
            foreach ($item as $value) {
                // 单元格内容写入
                $sheet->setCellValue($dataCol . $row, $value);
                $dataCol++;
            }
            $row++;
        }

        // save
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($name);
    }
}