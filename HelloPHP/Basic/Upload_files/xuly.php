<?php
echo 'trang xử lý';

if(!empty($_SERVER['REQUEST_METHOD'])){
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
}
if (array_key_exists('upload', $_FILES)) {
    $tmpFilePath = $_FILES['upload']['tmp_name'];
    $targetDirectory = "D:\\Application\\VSC\\HelloPHP\\upload_files\\uploads\\";
    $targetFilePath = $targetDirectory . basename($_FILES['upload']['name']);
    
    $result = move_uploaded_file($tmpFilePath, $targetFilePath);
    var_dump($result);
}