<?php
//Set cookie
//Cài đặt thời gian sống (86400 = 24x60x60)
setcookie(  'user',
            'học lập trình php',
            time() + 86400,
            '/',
            '',
            false,
            true
        );

//Đọc cookie
// echo $_COOKIE['user'];

//Xóa cookie

setcookie(  'user',
            'học lập trình php',
            time() -1,
            '/',
            '',
            false,
            true
        );
