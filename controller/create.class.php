<?php
class create{

    public function table()
    {
        $data = $_POST;

        $head = 'create table '.$data['table'].'(';
        $body = '';
        //var_dump($head);exit;
        for($i = 0;$i < $data['orig_num_fields']; $i++){
            $body .= $data['field_name'][$i].' '.$data['field_type'][$i].'('.$data['field_length'][$i].')'.' '.$data['field_extra'][$i].' comment "'.$data['field_comments'][$i].'"'.','."<br>";
        }
        $body .= 'primary key('.$data['field_name'][0].')';
        $end = ')engine='.$data['tbl_storage_engine'].' default charset=utf8 collate = utf8_general_ci';

        $sql = $head.$body.$end;

        $GLOBALS['data']->query('use '.$data['db']);
        $res = $GLOBALS['data']->query($sql);
        if($res){
            echo '成功';
        }else{
            var_dump('错了！！');
        }
    }

}