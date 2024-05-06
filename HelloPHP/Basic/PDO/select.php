<?php
require_once 'connect.php';

$sql = "select * from sinhvien";
try {
    $statement = $conn ->prepare($sql);
    $statement->execute();
    $data = $statement ->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r($data);
    echo '</pre>';
} catch (Exception $e) {
    echo $e ->getMessage() .'<br>';
    echo 'file: '.$e->getFile();
    echo 'line: '.$e->getLine();
}


$sql = "select * from sinhvien where id = ?";
try {
    $statement = $conn ->prepare($sql);
    $data = [2];
    $statement->execute($data);
    $data = $statement ->fetch(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r($data);
    echo '</pre>';
} catch (Exception $e) {
    echo $e ->getMessage() .'<br>';
    echo 'file: '.$e->getFile();
    echo 'line: '.$e->getLine();
}