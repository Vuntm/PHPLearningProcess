<?php
$title = [
    'pageTitle' => 'Đăng nhập'
];
layouts('header-login',$title);
if(isLogin()){
    redirect('?module=home&action=dashboard');
}

if(isPost()){
    $filterAll = filter();
    
    if(!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))){
        $password = trim($filterAll['password']);
        $email = trim($filterAll['email']);

        $getOneQuery = "select password,id from users where email = '$email'";
        $result = getOne($getOneQuery);
        if(!empty($result)){
            $id = $result['id'];
            $passwordVerify = passwordVerify($password, $result["password"]);
            if($passwordVerify){
                $userLogin = getOne("select * from loginToken where id = '$id'");
                if($userLogin > 0){
                    setFlashData('msg','Tài khoản đang đăng nhập ở 1 nơi khác');
                    setFlashData('msg_type','danger');
                    redirect('?module=auth&action=login');
                }else{
                    $tokenLogin = sha1(uniqid().time());
                    $data = [
                        'id'=>$id,
                        'token'=>$tokenLogin,
                        'created_at'=>date('Y-m-d H:i:s')
                    ];
                    $insert = insert('loginToken',$data);
                    if($insert){
                        setSession('loginToken',$tokenLogin);
                        redirect('?module=home&action=dashboard');
                    }else{
                        setFlashData('msg','Không thể đăng nhập vào lúc này');
                        setFlashData('msg','danger');
                    }
                }
            }else{
                setFlashData('msg','Mật khẩu không chính xác');
                setFlashData('msg_type','danger');
                redirect('?module=auth&action=login');
            }
        }else{
            setFlashData('msg','Email không tồn tại, vui lòng đăng ký tài khoản');
            setFlashData('msg_type','danger');
            redirect('?module=auth&action=login');
        }
    }else{
        print_r($filterAll);
        setFlashData('msg','Vui lòng nhập đủ thông tin');
        setFlashData('msg_type','danger');
        redirect('?module=auth&action=login');
    }
}
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
    <h2 class="text-center text-uppercase">Đăng nhập</h2>
        <?php if(!empty($msg)){getSmg($msg,$msg_type);} ?>
        <form action="" method='post'>
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Nhập email">
            </div>
            <div class="form-group mg-form">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" placeholder="nhập mật khẩu">
            </div>
            <button type="submit" class="mg-form btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng kí tài khoản</a></p>
        </form>
    </div>
</div>

<?php
layouts('footer-login')?>