<?php
$data = [
    'pageTitle'=>'Đặt lại mật khẩu'
];
layouts('header-login', $data);
$token = filter()['token'];
if(!empty($token)) {
    $tokenQuery = getOne("select id,fullname,email from users where forgotToken = '$token'");
if(!empty($tokenQuery)) {
    if(isPost()){
        $filterAll = filter();
        $errors = [];
        $id = $tokenQuery['id'];

        //Validate password
    if(empty($filterAll['password'])){
        $errors['password']['required'] = 'Mật khẩu không được để trống';
    }else{
        if(strlen($filterAll['password']) < 6){
            $errors['password']['minlength'] = 'Mật khẩu phải có ít nhất 6 ký tự';
        }
        if(strlen($filterAll['password']) > 30){
            $errors['password']['maxlength'] = 'Mật khẩu không được quá 30 ký tự';
        }
    }
    //Validate password_confirm
    if(empty($filterAll['password_confirm'])){
        $errors['password_confirm']['required'] = 'Mật khẩu không được để trống';
    }else{
        if($filterAll['password']!= $filterAll['password_confirm']){
            $errors['password_confirm']['notmatch'] = 'Mật khẩu không trùng khớp';
        }
    }
    if(empty($errors)){
        $passwordHash = passwordHash($filterAll['password'],PASSWORD_DEFAULT);
        $data =[
            'password'=> $passwordHash,
            'forgotToken'=>null,
            'updated_at'=> date('Y-m-d H:i:s')
        ];
        $update = update('users',$data,"id='$id'");
        if($update){
            setFlashData('msg','Thay đổi mật khẩu thành công');
            setFlashData('msg_type','success');
            redirect('?module=auth&action=login');
        }else{
            setFlashData('msg','Lỗi hệ thống');
            setFlashData('msg_type','danger');
        }
       
    }else{
        setFlashData('msg','Vui lòng kiểm tra lại thông tin');
        setFlashData('msg_type','danger');
        setFlashData('errors',$errors);
        redirect('?module=auth&action=resetpass&token='.$token);
    }
    }
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$erorrs = getFlashData('erorrs');
}

?>
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
    <h2 class="text-center text-uppercase">Đặt lại mật khẩu</h2>
    <?php
        if(!empty($msg)){
           getSmg($msg,$smg_type);
        }
    ?>
        <form action="" method='post'>
            <div class="form-group mg-form">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" placeholder="nhập mật khẩu">
                <?php echo form_error('password','<span class="error">','</span>',$errors); ?>
            </div>
            <div class="form-group mg-form">
                <label for="email">Nhập lại mật khẩu</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                <?php echo form_error('password_confirm','<span class="error">','</span>',$errors); ?>
            </div>
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <button type="submit" class="mg-form btn btn-primary btn-block">Gửi</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
        </form>
    </div>
</div>
<?php
}else{
    getSmg('Liên kết không tồn tại hoặc đã hết hạn','danger');
}

layouts('footer-login');