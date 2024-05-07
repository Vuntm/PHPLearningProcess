<?php
$title = [
    'pageTitle' => 'Đăng ký',
];

if(isPost()) {
    $filterAll = filter();
    $errors = [];
     //Validate fullname
     if(empty($filterAll['fullname'])){
        $errors['fullname']['required'] = 'Họ tên không được để trống';
    }else{
        if(strlen($filterAll['fullname']) < 6){
            $errors['fullname']['minlength'] = 'Họ tên phải có ít nhất 6 ký tự';
        }
        if(strlen($filterAll['fullname']) > 100){
            $errors['fullname']['maxlength'] = 'Họ tên không được quá 100 ký tự';
        }
    }
    //Validate email
    //Kiểm tra xem email đã được nhập chưa, đã nhập đúng chưa, đã tồn tại trong csdl chưa
    if(empty($filterAll['email'])){
        $errors['email']['required'] = 'Email không được để trống';
    }else{
        $email = trim($filterAll['email']);
        $getEmail = "select id from users where email = '$email'" ;
        if(getRowCount($getEmail) > 0){
            $errors['email']['existed'] = 'Email đã tồn tại';
        }else if(!filter_var($filterAll['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email']['invalid'] = 'Email không đúng định dạng';
        }
    }
    //Validate phone_number
    if(empty($filterAll['phone_number'])){
        $errors['phone_number']['required'] = 'Số điện thoại không được để trống';
    }else{
        if(!isPhone($filterAll["phone_number"])){
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ';
        }
    }
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
        //xử lý insert
        $activeToken = sha1(uniqid().time());
        $dataInsert = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone_number'],
            'password' => passwordHash($filterAll['password'],),
            'activeToken'=> $activeToken,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 0
        ];

        $insertData = insert('users', $dataInsert);
        if($insertData){
            setFlashData('smg','Đăng ký thành công');
            setFlashData('smg_type','success');
            $linkActive = _WEB_HOST . '?module=auth&action=active&token='.$activeToken;
            $subject = strtoupper($filterAll['fullname']).', Vui lòng kích hoạt tài khoản!!';
            $content = 'Xin chào '.$filterAll['fullname'].',</br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản: </br>';
            $content .= $linkActive . '</br>';
            $content .= 'Nếu không phải bạn vui lòng bỏ qua email này. </br> Trân trọng cảm ơn!!';
            $sendMail = sender($filterAll['email'],$subject,$content);
            if($sendMail){
                setFlashData('smg','Đăng ký thành công, vui lòng kiểm tra email để xác thực');
                setFlashData('smg_type','success');
            }else{
                setFlashData('smg','Hệ thống đang gặp sự cố vui lòng thử lại sau');
                setFlashData('smg_type','danger');
            }
            redirect('?module=auth&action=register');
        }else{
            setFlashData('smg','Đăng ký thất bại');
            setFlashData('smg_type','danger');
        }
    }else{
        setFlashData('smg','Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_type','danger');
        setFlashData('errors',$errors);
        setFlashData('old',$filterAll);
        redirect('?module=auth&action=register');
    }
}
layouts('header-login', $title);
$errors = getFlashData('errors');
$old = getFlashData('old');


$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');

?>
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
    <h2 class="text-center text-uppercase">Đăng ký</h2>
    <?php
        if(!empty($smg)){
           getSmg($smg,$smg_type);
        }
    ?>
        <form action="" method='post'>
        <div class="form-group mg-form">
                <label for="fullname">Họ tên</label>
                <input name="fullname" type="fullname" class="form-control" placeholder="Nhập họ tên" value="<?php
                echo old_data('fullname',$old)?>">
                <?php echo form_error('fullname','<span class="error">','</span>',$errors); ?>
            </div>
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Nhập email"value="<?php
                echo old_data('email',$old)?>">
                <?php echo form_error('email','<span class="error">','</span>',$errors); ?>
           </div>
            <div class="form-group mg-form">
                <label for="email">Số điện thoại</label>
                <input name="phone_number" type="number" class="form-control" placeholder="Nhập số điện thoại"value="<?php
                echo old_data('phone_number',$old)?>">
                <?php echo form_error('phone_number','<span class="error">','</span>',$errors); ?>
            </div>
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
            <button type="submit" class="mg-form btn btn-primary btn-block">Đăng ký</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
        </form>
    </div>
</div>

<?php
layouts('footer-login')?>