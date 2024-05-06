<!-- Bài 1: Viết chương trình lấy 5 ký tự cuối chuỗi -->
<?php
$str = "Hello PHP!";
$endStr = substr($str,-5);
echo '5 ký tự cuối của chuỗi '.$str.' là '.$endStr;

//thêm mb_ trước hàm để dùng được tiếng việt
$str2 = "Xin chào PHP!";
$endStr2 = mb_substr($str2,-5, null,'UTF-8');
echo '5 ký tự cuối của chuỗi '.$str.' là '.$endStr2;


// Bài 2: Viết chương trình xóa chữ đầu tiên trong chuỗi
$str3 = "Hello PHP!";
$endStr3 = mb_substr($str3,1, null,'UTF-8');
echo 'chuỗi sau khi ký tự đầu của chuỗi '.$str3.' được xóa là '.$endStr3;