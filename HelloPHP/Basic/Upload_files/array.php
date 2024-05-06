<?php

//Khai báo mảng
$arr = array('1', '2', '3', '4');
$arr2 = ['key1' =>'1','key2'=> '2','key3'=> '3','key4'=> '4'];


//Thêm phần tử vào mảng

$arr[]='5';
$arr2['key5']= '5';

array_push($arr,'6');

//Sửa mảng
$arr2['key2']= 'key2';

//Xóa mảng
unset($arr2['key1']);

//in mảng
echo '<pre>';
print_r($arr2).'<br>';
echo '</pre>';


//Đọc mảng
//Hiển thị biến có key = key2
echo $arr2['key2']; 

//Dùng vòng lặp for
if(!empty($arr)){
    for($i = 0;$i < count($arr);$i++){
        echo $arr[$i].'<br>';
    }
}

//Dùng vòng lặp foreach
if(!empty($arr2)){
    foreach($arr2 as $item){
        echo $item.'<br>' ;
    }
}
