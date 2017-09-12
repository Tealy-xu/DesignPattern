<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/28 0028
 * Time: 下午 11:16
 */

//工厂方法 Factory Method
//修改是封闭的 扩展是开放的
interface db{
    function conn();
}

interface Factory{
    function createDB();
}

class dbmysql implements db{
    public function conn()
    {
        echo 'mysql conn success!!!';
    }
}

class mysqlFactory implements Factory{
    public function createDB()
    {
        return new dbmysql();
    }
}

class dbsqlite implements db{
    public function conn()
    {
        echo 'dbsqlite conn success!!!';
    }
}

class sqliteFactory implements Factory{
    public function createDB()
    {
        return new dbsqlite();
    }
}


//==========服务器添加oracle类====
//前面的代码不用改
class dboracle implements db{ //写接口
    public function conn()
    {
        echo 'oracle conn success!!!';
    }
}

class oracleFactory implements Factory{ //创建接口的连接
    public function createDB(){
        return new dboracle();
    }
}


//==========客户端开始============
$fact = new mysqlFactory();
$db   = $fact->createDB();
$db->conn();

$fact = new sqliteFactory();
$db   = $fact->createDB();
$db->conn();

$fact = new oracleFactory();
$db   = $fact->createDB();
$db->conn();