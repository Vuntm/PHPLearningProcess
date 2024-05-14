<?php
require_once('connect.php');
function query($sql, $data = [],$check = false){
    global $conn;
    $result = false;
    try {
        $statement = $conn -> prepare($sql);
        if(!empty($data)){
            $result = $statement -> execute($data);
        }else{
            $result = $statement -> execute();
        }
       
    } catch (Exception $e) {
        echo $e ->getMessage() .'<br>';
        echo 'file: '.$e->getFile();
        echo 'line: '.$e->getLine();
    }
    if($check){
        return $statement;
    }
    return $result;
}

function insert($table, $data = []){
    $key = array_keys($data);
    $values = ':'.implode(',:', $key);
    $attribute = implode(',', $key);

    $sql = "insert into " .$table ." (".$attribute.") values (".$values.")";
    return query($sql, $data);
}

function update($table, $data = [],$conditions =''){
    $update = '';
    foreach ($data as $key => $value) {
        $update.= $key.'= :'.$key.',';
    }
    $update = rtrim($update, ',');
   if(!empty($conditions)){
    $sql = "update " .$table ." set ".$update." where ".$conditions;
   }else{
    $sql = "update " .$table ." set ".$update;
    }
return query($sql, $data);
}

function delete($table, $conditions =''){
    if(!empty($conditions)){
        $sql = "delete from " .$table ." where ".$conditions;
    }else{
        $sql = "delete from " .$table ;
    }
    return query($sql);
}

function getAll($sql){
    $result = query($sql, '',true);
    if(is_object($result)){
        $dataFetch = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

function getOne($sql){
    $result = query($sql, '',true);
    if(is_object($result)){
        $dataFetch = $result->fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

function getRowCount($sql){
    $result = query($sql, '',true);
    if(!empty($result)){
    return $result->rowCount();
    }
    return 0;
}
// echo getRowCount("select id from users where email = 'kairy9223@gmail.com'");