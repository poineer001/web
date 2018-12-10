<?php
function db_connect(){
    $result = new mysqli('localhost','limit','god24','power');
    if(!$result){
        throw new  Exception('无法连接数据库呢');
    }else{
        return $result;
    }


}
?>
