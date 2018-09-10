<?php

class db{

    private static $link,$result;   //设置私有变量

    function __construct($config)   //构建析构函数，在实例化 db 类之前连接数据库
    {
        self::$link = mysqli_connect($config['host'],
                       $config['username'],
                       $config['password'],
                       $config['database']
        );
        //设置字符集为 utf8
        mysqli_query(self::$link,'set names utf8');
    }

    /**
     * @desc 执行 sql 语句，返回本身
     * @param $sql
     * @return $this
     */
    public function query($sql)
    {
        self::$result = mysqli_query(self::$link,$sql);

        return $this;
    }

    /**
     * @desc 将只想完毕的 sql 转化为数组，并返回
     * @return array|null
     */
    public function fetchAll()
    {
        $s = mysqli_fetch_all(self::$result,MYSQLI_ASSOC);
        return $s;
    }

    /**
     * @desc 添加功能
     * @param $tableName
     * @param array $array
     */
    public function add($tableName,$array = array())
    {
        $str = '(';
        foreach ($array as $k=>$v){
            if(is_string($v)){
                $v = "'".$v."'";
            }
            if(empty($v)){
                $v = 'null';
            }
            $str .= $v.',';
        }
        $str = rtrim($str,',');
        $str .= ')';

        $sql = 'insert into '.$tableName.' values '.$str;

        $res = $this->query($sql);

        if($res){
            echo 'successfully insert';
        }else{
            echo 'defeat';
        }
    }

    /**
     * @desc 修改功能
     * @param $tableName
     * @param array $arr
     * @param $condition
     */
    public function update($tableName,$arr = array(),$condition)
    {
        $str = '';
        foreach ($arr as $k=>$v){
            if(is_string($v)){
                $v = "'".$v."'";
            }
            $str .= $k ."=".$v.',';
        }
        $str = rtrim($str,',');
        $sql = 'update '.$tableName.' set '.$str.' where '.$condition;

        $res = $this->query($sql);
        if($res){
            echo 'successfully update';
        }else{
            echo 'defeat';
        }
    }

    /**
     * @desc 删除功能
     * @param $tableName
     * @param $condition
     */
    public function delete($tableName,$condition)
    {
        $sql = 'delete from '.$tableName.' where '.$condition;
        $res = $this->query($sql);
        if($res){
            echo 'successfully delete';
        }else{
            echo 'defeat';
        }
    }
}