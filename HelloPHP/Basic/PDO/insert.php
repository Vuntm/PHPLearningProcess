<?php
require_once 'connect.php';

$sql = 'insert into sinhvien(fullname, age) values(:fullname,:age)';

try {
    $statement = $conn -> prepare(($sql));
    $fullname = 'tegetege';
    $age = '50';
    $data =[
        'fullname' => $fullname,
        'age' => $age
    ];

$resutl = $statement -> execute($data);
var_dump($resutl);
} catch (Exception $e) {
    echo $e ->getMessage() .'<br>';
    echo 'file: '.$e->getFile();
    echo 'line: '.$e->getLine();
}

