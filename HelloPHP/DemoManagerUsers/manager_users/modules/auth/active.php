<?php
layouts('header-login');
$token = filter()['token'];
if(!empty($token)) {
    $tokenQuery = getOne("select id from users where activeToken = '$token'");
    if($tokenQuery){
        $id = $tokenQuery['id'];
        $data = [
            'status'=>1,
            'activeToken'=>null
        ];
        $update = update('users',$data,"id=$id");
        if($update){
            setFlashData('msg','Kích hoạt tài khoản thành công');
            setFlashData('msg_type','success');
            redirect('?module=auth&action=login');
        }else{
            setFlashData('msg','Kích hoạt tài khoản thất bại');
            setFlashData('msg_type','danger');
        }
    }else{
        getSmg('Không tìm thấy liên kết','danger');
    }
}

layouts('footer-login');