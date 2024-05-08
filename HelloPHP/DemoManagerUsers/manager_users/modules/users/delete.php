<?php
$filterAll = filter();
if(!empty($filterAll)) {
    $id = $filterAll['id'];
    $userDetail = getOne("select * from users where id = '$id'");
    if($userDetail > 0){
        $deleteTokenLogin = delete('loginToken',"id=$id");
        if($deleteTokenLogin){
           $deleteUser =  delete('users',"id = $id");
           if($deleteUser){
            setFlashData('msg','Xóa thành công');
            setFlashData('msg_type','success');
           }
        }
        else{
            setFlashData('msg','Token login không tồn tại');
            setFlashData('msg_type','danger');
        }
    }else{
        setFlashData('msg','User không tồn tại');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}

redirect(_WEB_HOST.'/?module=users&action=list');