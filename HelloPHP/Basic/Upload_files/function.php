<?php

function makeTotal($a,$b){
    $tong = $a+$b;
    echo 'Tổng là' .$tong;
}

if(!function_exists('makeTotal')){
    function makeTotal($a,$b){
        echo "Fucntion vừa được tạo";
        $tong = $a+$b;
        echo 'Tổng là' .$tong;
    }
}
makeTotal(10,11);
