<?php
$title = [
    'pageTitle' => 'Thêm tài khoản',
];
$filterAll = filter();
if(!empty($filterAll['id'])) {
    $id = $filterAll['id'];

    $userDetail = getOne("select * from users where id='$id'");
    if(!empty($userDetail)) {
        setFlashData('user-detail',$userDetail);
    }else{
        redirect("?module=users&action=list");
    }
}

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
        $getEmail = "select id from users where email = '$email' and id <> $id" ;
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

    
    if(!empty($filterAll['password'])){
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
    }

    if(empty($errors)){
        $dataUpdate = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone_number'],
            'created_at' => date('Y-m-d H:i:s'),
            'status' => $filterAll['status']
        ];

        if(!empty($filterAll['password'])){
            $dataUpdate = [
                'fullname' => $filterAll['fullname'],
                'email' => $filterAll['email'],
                'phone' => $filterAll['phone_number'],
                'created_at' => date('Y-m-d H:i:s'),
                'status' => $filterAll['status'],
                'password' => passwordHash($filterAll['password'].PASSWORD_DEFAULT)
            ];
        }
        $condition = "id ='$id'";
        $updateStatus = update('users', $dataUpdate, $condition);
        if(!empty($updateStatus)){
            setFlashData('msg','Update thành công');
            setFlashData('msg_type','success');
            }else{
                setFlashData('msg','Sửa thất bại');
                setFlashData('msg_type','danger');
            }
              
    }else{
        setFlashData('msg','Vui lòng kiểm tra lại thông tin');
        setFlashData('msg_type','danger');
        setFlashData('errors',$errors);
        setFlashData('old',$filterAll);
        redirect('?module=users&action=add');
    }
    redirect('?module=users&action=edit&id='.$id);
}

layouts('header', $title);
$errors = getFlashData('errors');
$old = getFlashData('old');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$userDetail = getFlashData('user-detail');
if(!empty($userDetail)){
    $old = $userDetail;
}

?>
<div class="container">
    <div class="row" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Thông tin người dùng</h2>
        <?php
        if(!empty($msg)){
           getSmg($msg,$msg_type);
        }
    ?>
        <form action="" method='post'>
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="fullname">Họ tên</label>
                        <input name="fullname" type="fullname" class="form-control" placeholder="Nhập họ tên" value="<?php
                echo old_data('fullname',$old)?>">
                        <?php echo form_error('fullname','<span class="error">','</span>',$errors); ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Nhập email" value="<?php
                echo old_data('email',$old)?>">
                        <?php echo form_error('email','<span class="error">','</span>',$errors); ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="email">Số điện thoại</label>
                        <input name="phone_number" type="number" class="form-control" placeholder="Nhập số điện thoại"
                            value="<?php
                echo old_data('phone',$old)?>">
                        <?php echo form_error('phone_number','<span class="error">','</span>',$errors); ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="nhập mật khẩu">
                        <?php echo form_error('password','<span class="error">','</span>',$errors); ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="email">Nhập lại mật khẩu</label>
                        <input name="password_confirm" type="password" class="form-control"
                            placeholder="Nhập lại mật khẩu">
                        <?php echo form_error('password_confirm','<span class="error">','</span>',$errors); ?>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" id="" class="form-control">
                            <option value="0">Chưa kích hoạt</option>
                            <option value="1">Đã kích hoạt</option>
                        </select>
                        <br>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                </div>
            </div>
            <button type="submit" class="mg-form btn btn-primary btn-block">Thêm</button>
            <a href="?module=users&action=list" class="mg-form btn btn-success btn-block">Quay lại</button>
        </form>
    </div>
</div>

<?php
layouts('footer')?>