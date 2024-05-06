<?php
$title = [
    'pageTitle' => 'Đăng nhập'
];
layouts('header',$title);

?>
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
    <h2 class="text-center text-uppercase">Đăng nhập</h2>
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
layouts('footer')?>