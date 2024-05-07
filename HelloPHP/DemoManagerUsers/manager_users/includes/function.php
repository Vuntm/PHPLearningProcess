<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function layouts($layoutName ="",$title = []){
    if(file_exists(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php')){
        require_once(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php');
    }
}

function sender($to, $subject, $content){
    $mail = new PHPMailer(true);



//Create an instance; passing `true` enables exceptions

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'minhvu090203@gmail.com';                     //SMTP username
    $mail->Password   = 'ereh fjce qryq kwgu';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('minhvu090203@gmail.com', 'DemoManagerUserByPHP');
    $mail->addAddress($to);     //Add a recipient

    //Content
    $mail->CharSet = 'utf-8';
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;

    $mail->send();
    echo 'Message has been sent';
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

//Kiểm tra phương thức get
function isGet(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    return false;
}

function isPost(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    return false;
}

//Hàm filter lọc dữ liệu
function filter(){
    $filterArr = [];
    if(isGet()){
        // return $_GET;
        if(!empty($_GET)){
            foreach($_GET as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                }
                $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }
    if(isPost()){
        // return $_GET;
        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                }
                $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }
    return $filterArr;
}

//Kiểm tra email
function isEmail($email){
    $checkEmail = filter_var($email,FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

//Hàm kiểm tra số nguyên
function isNumberInt($number){
    $checkNumber = filter_var($number,FILTER_VALIDATE_INT);
    return $checkNumber;
}

//Hàm kiểm tra số thực
function isNumberFloat($number){
    $checkNumber = filter_var($number,FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

//Mã hóa mật khẩu
function passwordHash($password){
    return password_hash($password,PASSWORD_DEFAULT);
}

//Kiểm tra mật khẩu
function passwordVerify($input,$password){
    return password_verify($input,$password);
}

//Kiểm tra số điện thoại

function isPhone($phone){
    $checkZero = false;
    if($phone[0] == 0){
        $checkZero = true;
        $phone = substr($phone, 1);
    }
    $checkNumber = false;
    if(isNumberInt($phone)&&strlen($phone)==9){
    $checkNumber = true;
    }
    if($checkNumber && $checkZero){
        return true;
    }
}

//Thông báo lỗi 
function getSmg($smg, $type = '') {
    echo '<div class="alert alert-'.$type.'">'.print_r($smg, true).'</div>';
}

function redirect($path='index.php'){
    header("location: $path");
    exit();
}

function form_error($fileName, $beforeHtml= '',$afterHtml='',$error){
    return (!empty($error[$fileName]))?'<span class="error">'.reset($error[$fileName]).'</span>':null;
}

function old_data($fileName,$oldData, $default=null){
    return (!empty($oldData[$fileName]))?$oldData[$fileName]:$default;
}

function isLogin(){
    $checkLogin = false;
if(getSession('loginToken')){
    $tokenLogin = getSession('loginToken');
    $queryToken = getOne("select user_id from loginToken where token = '$tokenLogin'");
    if(!empty($queryToken)){
        $checkLogin = true;
    }else{
        removeSession('loginToken');
    }
}
return $checkLogin;
}