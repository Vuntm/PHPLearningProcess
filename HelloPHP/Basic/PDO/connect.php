<?php

const _HOST = 'localhost';
const _DB = 'demomyadmin';
const _USER = 'root';
const _PASSWORD = '';

try {
    if(class_exists('PDO')){
        $dsn = 'mysql:dbname='._DB.';host='._HOST;
        $option =[
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Tạo thông báo ra ngoại lệ khi gặp lỗi
        ];
        $conn = new PDO($dsn, _USER, _PASSWORD);
        if($conn){
            echo "complete ";
        }
    }
} catch (Exception $e) {
        echo 'Error: '.$e->getMessage().'<br>';
        die();
}