<?php
//DB.php
//最终版本: 兼容绑定值操作
namespace libs;

use PDO;

class Db
{
    protected static $pdo = null;

    //搭建数据库连接
    protected static function connect()
    {
        if (self::$pdo == null) {
            $dsn = 'mysql:dbname=test;host=localhost;port=3306';
            self::$pdo = new PDO($dsn, 'root', 'ps5566');
        }
        return self::$pdo;
    }

    //获取版本号:
    public static function version()
    {
        self::connect();
        return self::$pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    }

    protected static function prepare($sql, $args = [])
    {
        self::connect();
        $stmt = self::$pdo->prepare($sql);

        foreach ($args as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $suc = $stmt->execute();

        if ($suc == false) {
            echo '<pre>';
            print_r($stmt->errorInfo());
            echo '</pre>';
            die;
        }
        return $stmt;
    }

    /**
     * 多条查询
     *
     * @param string $sql
     * @return mixed 成功时返回二维数组, 没有数据则返回空数组
     */
    public static function fetchAll($sql, $args = [])
    {
        return self::prepare($sql, $args)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 单条查询
     *
     * @param string $sql sql语句
     * @return mixed 有数据则返回一维数组, 没有数据返回false
     */
    public static function fetch($sql, $args = [])
    {
        return self::prepare($sql, $args)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 执行增删改
     * 
     * @param string $sql 数据库语句
     * @return mixed 成功时返回影响的行数, 失败是返回false
     */
    public static function exec($sql, $args = [])
    {
        return self::prepare($sql, $args)->rowCount();
    }
}
