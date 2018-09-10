<?php

class login{
    function index()
    {
        include 'views/login.html';
    }

    function doLogin()
    {
        /*$username = $_POST['username'];
        $password = $_POST['passwrod'];
        //var_dump($username,$password);exit;
        $sql = 'select User from user where User="'.$username.'"';
        $res = $GLOBALS['data']->query($sql)->fetchAll();*/

        //var_dump($sql);exit;
        /*if($res){*/
            //存入session
            /*session_start();
            $_SESSION['user'] = json_encode($res);*/

            //展示数据库
            $sql = 'show databases;';
            $res = $GLOBALS['data']->query($sql)->fetchAll();
            foreach ($res as $k=>$v){
                $res[$k] = $v['Database'];
            }
            //var_dump($res);exit;

            include "views/homePage.html";
        /*}*/
    }

    public static function getTable()
    {
        $database = $_GET['database'];//接收

        $GLOBALS['data']->query('use '.$database);
        $res = $GLOBALS['data']->query('show tables;')->fetchAll();
        //var_dump($res);exit;
        $arr = [];
        foreach($res as $k=>$v){
            foreach ($v as $key=>$value){
                $arr[] = $value;
            }
        }
        //var_dump($arr);exit;
        //var_dump($database);exit;
        include 'views/showtable.html';
    }

    public static function getList()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];
        //var_dump($database,$table);exit;
        include 'views/showlist.html';
    }

    public static function getLie()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];

        $lie = $GLOBALS['data']->query('desc '.$database.'.'.$table)->fetchAll();

        include 'views/showlie.html';
    }

    public static function getIndex()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];

        $index = $GLOBALS['data']->query('desc '.$database.'.'.$table)->fetchAll();

        include 'views/showindex.html';
    }
}
