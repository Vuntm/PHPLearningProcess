<!-- Validate form Client: Bắt lỗi phía dao diện (HTML,JS)
Validate form server PHP -->
<?php

//Bắt lỗi với fullname
$errors = [];
if(!empty($_POST)){


    if(empty($_POST['fullname'])){
        $errors['fullname']['required'] = 'Họ tên không được để trống';
    }else{
        if(strlen($_POST['fullname'])<=5){
            $errors['fullname']['min_length'] = 'Họ tên phải lớn hơn 5 ký tự';
        }
    }
    //Bắt lỗi với email
    if(empty($_POST['email'])){
        $errors['email']['required'] = 'Email không được để trống';
    }else{
       if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email']['invalid'] = 'Email không đúng định dạng';
       }
    }
}

// if(!empty($errors)){
//     print_r($errors);
// }else{
//     echo 'Validate thành công';
// }
echo '<pre>';
print_r($errors);
echo '</pre>';
?>

<form action="" method="post">
    <p>Họ tên <input type="text" name="fullname" placeholder="Họ và tên">
                <?php echo !empty($errors['fullname']['required'])? $errors['fullname']['required']:'';?>
                <?php echo !empty($errors['fullname']['min_length'])? $errors['fullname']['min_length']:'';?>
            </p>
    <p>Email <input type="text" name="email" placeholder="Email"></p>
    <p>Xác nhận <button type="submit">Gửi</button></p>
</form>

