<?php
require './DengComments.php';
require './DengExcel.php';
require_once './lib/Db.php';

use DengComments\DengComments;
use DengExcel\DengExcel;
use libs\Db;
$excel = new DengExcel();
$comment = new DengComments();

$excelData = $excel->read('./upload/excel/1.xlsx');
$tableData = $comment->getFieldAndComments('excel_test', 'test');

//将表格中的
//将表头对应注释，对应后把原来对应表头（也就是注释）值对应到字段名
//找到注释对应的字段后，一个一个循环后面的数据块，格式化数组
$tableHeader = $excelData[1];
foreach ($tableData as $dataKey => $dataVal) {
    foreach ($tableHeader as $headerKey => $headerVal) {
        if($dataVal['comment'] == $headerVal){
            $i = 0; //组装后数据索引 
            foreach ($excelData as $key => $value) {
                //跳过表头
                if($key == 1){
                    continue;
                }
                $data[$i++][$dataVal['field']] = $value[$headerKey];
            }
        }
    }
}
foreach ($data as $key => $value) {
    Db::exec("INSERT INTO excel_test (`name`, `content`, `order`) VALUES (:name, :content, :order)", $value);
}

echo '<pre>';
print_r($data);
echo '</pre>';
