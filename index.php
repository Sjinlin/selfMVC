<?php

header('Content-type:text/html;charset=utf-8');

if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/'){
    $pathInfo = '/home/index';
}else{
    $pathInfo = $_SERVER['PATH_INFO'];//获取到路径后的参数
}

$pathInfo = ltrim($pathInfo,'/');

$pathInfo = explode('/',$pathInfo);

//var_dump($pathInfo);exit;

//-----------连接数据库准备----------
include 'common/db.config.php';//包含公共文件
include 'vender/db.class.php'; //包含主要文件

$GLOBALS['data'] = new db($config);
//-----------数据库准备结束----------

//定义public常量
//define("__PUBLIC__",'http://localhost/self-mvc');
//var_dump(__PUBLIC__);exit;

//--------------包含参数所指向的类与方法--------------
include 'controller/'.$pathInfo[0].'.class.php';

@call_user_func_array($pathInfo,array());


?>