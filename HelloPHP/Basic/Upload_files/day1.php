<?php
$bien_1 = 10;
$bien_2 = "biến 1";

echo "$bien_1 là $bien_2";

// Hằng số trong php
define('_MINHVU',10);
echo _MINHVU;

//Các kiểu dữ liệu trong PHP
$bienint = '1';
//Ép kiểu
$bienepkieu = (int)$bienint;
//kiểm tra
if(is_int($bienepkieu)){
    echo 'Đây là kiểu số nguyên';
}

$day = 1;
switch($day) {
    case 2: 
        echo 'Thứ hai';
        break;
    case 3:
        echo 'Thứ ba';
        break;
    case 4:
        echo 'Thứ tư';
        break;
    case 5:
        echo 'Thứ năm';
        break;
    case 6:
        echo 'Thứ sáu';
        break;
    case 7:
        echo 'Thứ bảy';
        break;
    case 8:
        echo 'Chủ nhật';
        break;
    default:
        echo 'Không phải ngày trong tuần';
        break;
}

//Cú pháp thay thế if
$a = 5;
if($a <0 ):
    echo 'Biến a nhỏ hơn 0';
else:echo'Biến a lớn hơn 0';
endif;

//Cú pháp thay thế for

for($a=0;$a<10;$a++):
    echo $i;
endfor;

//Cú pháp thay thế while
$i = 0;
while($i < 10):
    echo $i;
    $i++;
endwhile;
