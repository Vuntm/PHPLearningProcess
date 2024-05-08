<?php
if(!isLogin()){
    redirect('?module=auth&action=login');
}
$filter = filter()['id'];
$user = getOne("select status from users where id='$filter'");
if($user['status'] == 1){
    print_r(getOne("select * from users where id = 'filter'"));
    $data=['status'=>0];
    $update = update('users',$data,"id=$filter");
    print_r(getOne("select * from users where id = 'filter'"));
}else{
    print_r(getOne("select * from users where id = 'filter'"));
    $data=["status"=> 1];
    $update = update('users',$data,"id=$filter");
    print_r(getOne("select * from users where id = 'filter'"));
}
redirect(_WEB_HOST.'/?module=users&action=list');