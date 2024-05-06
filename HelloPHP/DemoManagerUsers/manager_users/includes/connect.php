<?php
require_once('D:\Application\VSC\HelloPHP\Day2\manager_users\config.php');

try {
    if(class_exists('PDO')){
        $dsn ='mysql:dbname='._DB.';host='._HOST;
        $option =[
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Tạo thông báo ra ngoại lệ khi gặp lỗi
        ];
        $conn = new PDO($dsn, _USER, _PASSWORD,$option);
        if($conn){
            echo "Connected! ";
        }
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage().'<br>';
    die();
}