<?php
$title = ['pageTitle'=>'Dashboard'];
layouts('header', $title);
if(!isLogin()){
    redirect('?module=auth&action=login');
}
layouts('footer');