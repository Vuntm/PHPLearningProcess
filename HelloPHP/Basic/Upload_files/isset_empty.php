<?php
//Bật thông báo về lỗi
ini_set('display_errors','1');
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$bien1 = 'Minh Vu';

if(isset($bien1)){
    echo $bien1;
}


//Empty
echo '<br>';
$string = 0;

if(!empty($string)){
    echo($string);
}else{
    echo 'Chuỗi rỗng';
}

