<?php
$arr = array();
$arr2 =[
    'address' => [
        'name' => 'Vu',
        'email' => 'vuntm@gmail.com'
    ],
    'address2' => [
        'name' => 'Minh',
        'email'=> 'minh@gmail.com'
    ]
];

echo $arr2['address']['name'].'<br>';

if(!empty(($arr2))){
    foreach($arr2 as $i){
        echo $i['name'].'<br>';
        echo $i['email'].'<br>';
    }
}
//Lưu ý: trước khi duyệt mảng và hiển thị phần tử nên check xem mảng
//        có phải mảng hay không -> kiểm tra xem mảng có phần tử hay không

echo 'Hàm array_push';
$result = array_push($arr2,'ro7','m10');
echo '<pre>';
print_r($arr2);
echo '</pre>';
echo $result;

//Hàm array_shift - Xóa phần tử ở đầu mảng
echo 'Hàm array_shift';
array_shift($arr2);
echo '<pre>';
print_r($arr2);
echo '</pre>';

//Hàm array_unshift - Thêm 1 hoặc nhiều phần tử vào đầu mảng
echo 'Hàm array_unshift';
array_unshift($arr2,'mvu','mvux');
echo '<pre>';
print_r($arr2);
echo '</pre>';

//Hàm in_array -Kiểm tra xem trong mảng có phần tử cần tìm kiếm không
echo 'Hàm in_array';
$rs = in_array('mvux',$arr2);
echo '<pre>';
print_r($arr2);
echo '</pre>';
echo $rs;

