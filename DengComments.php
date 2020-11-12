<?php

namespace DengComments;

require './lib/Db.php';

use libs\Db;

class DengComments
{
    /**
     * 返回某表的字段名和注释
     *
     * @return array
     */
    public function getFieldAndComments($table_name, $table_schema)
    {
        //table_name 表名
        //table_schema 数据库名
        $list = Db::fetchAll("SELECT COLUMN_NAME as field,COLUMN_COMMENT as comment FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table_name AND TABLE_SCHEMA = :table_schema", ['table_name' => $table_name, 'table_schema' => $table_schema]);
        return $list;
    }
}
