<?php

class show{
    function index(){
        //echo "hello you're so beautiful";
        //include 'views/index.html';
        //$v = $GLOBALS['data']->query('select * from actor;')->fetchAll();
        //$s = $GLOBALS['data']->add('actor',array('id'=>null,'name'=>'霍建华'));
        //var_dump($v);exit;
    }

    public function table()
    {
        $tableName = $_GET['tableName'];
        //var_dump($tableName);exit;
        $GLOBALS['data']->query('use '.$tableName); //改变数据库
        $result = $GLOBALS['data']->query('show tables;')->fetchAll();

        foreach ($result as $k=>$v){
            $result[$k] = $v['Tables_in_'.$tableName];
        }

        //var_dump($result);exit;
        include 'views/tableList.html';
    }

    public function tableList()
    {
        $database = $_GET['database'];
        $GLOBALS['data']->query('use '.$database);
        $result = $GLOBALS['data']->query('show tables;')->fetchAll();

        foreach ($result as $k=>$v){
            $result[$k] = $v['Tables_in_'.$database];
        }
        include 'views/table.html';
    }

    public function createDatabase()
    {
        $value = $_GET['value'];

        $res = $GLOBALS['data']->query('show databases;')->fetchAll();

        //var_dump($res);exit;

        foreach ($res as $k=>$v){
            $res[$k] = $v['Database'];
        }

        include 'views/database.html';
    }

    public function dataList()
    {
        $table = $_GET['table'];
        $database = $_GET['database'];

        $GLOBALS['data']->query('use '.$database);
        $sql = 'select * from '.$table;

        $result = $GLOBALS['data']->query($sql)->fetchAll();

        $lie = $result[0];
        //var_dump($lie);
        include 'views/list.html';
    }

    public function createTable()
    {
        $database = $_GET['database'];

        $sql = $_GET['sql'];

        include 'views/create/table.html';
    }

    public function dialog()
    {
        include 'views/dialog.html';
    }
}



?>