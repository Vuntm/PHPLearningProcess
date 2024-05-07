<?php
$data= [
    'pageTitle'=>'Quên mật khẩu'
];
layouts('header-login', $data);
$filterAll = filter();
    if(isPost()){
      if(!empty($filterAll['email'])){
        $email = $filterAll['email'];

        $emailQuery = getOne("select id,fullname from users where email = '$email'");
        if(!empty($emailQuery)){
            $id = $emailQuery['id'];

            $forgotToken = sha1(uniqid().time());
            $data = [
                'forgotToken'=>$forgotToken
            ];
            $update = update('users',$data,"id = '$id'");
            if($update){
                $fullname = $emailQuery['fullname'];
                $link = _WEB_HOST.'?module=auth&action=reset&token='.$forgotToken;
                $subject = "YÊU CẦU KHÔI PHỤC MẬT KHẨU";
                $content = "Chào $fullname";
                $content .= "Chúng tôi nhận được yêu cầu thay đổi mật khẩu của bạn. Nếu là bạn vui lòng click vào link sau: $link";
                $content .= 'Nếu không phải bạn vui lòng bỏ qua. Cảm ơn!!';

                $result = sender($email,$subject,$content);
                if($result){
                    setFlashData('msg','Vui lòng kiểm tra email');
                    setFlashData('msg','success');
                }else{
                    setFlashData('msg','Lỗi hệ thống, vui lòng thử lại sau');
                    setFlashData('msg_type',"danger");
                }
            }else{
                setFlashData('msg','Lỗi hệ thống, vui lòng thử lại sau');
                setFlashData('msg_type',"danger");
            }
        }else{
            setFlashData('msg','Địa chỉ email không tồn tại');
            setFlashData('msg_type','danger');
        }
      }else{
        setFlashData('msg','Vui lòng nhập địa chỉ email');
        setFlashData('msg_type','danger');
      }
    }
?>
<div class="row">
<div class="col-4" style="margin: 50px auto;">
<h2 class="text-center text-uppercase">Quên mật khẩu</h2>
    <?php if(!empty($msg)){getSmg($msg,$msg_type);} ?>
    <form action="" method='post'>
        <div class="form-group mg-form">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Nhập email">
        </div>
        <button type="submit" class="mg-form btn btn-primary btn-block">Gửi</button>
        <hr>
        <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
        <p class="text-center"><a href="?module=auth&action=register">Đăng kí tài khoản</a></p>
    </form>
</div>
</div>

<?php
layouts('footer-login')?>