<?php
try {
    echo 'hello PHP! <br>';
    // hienthi();
} catch (Error $e) {
    echo $e->getMessage() . '<br>';
    echo 'File: '.$e -> getFile(). '<br>';
    echo 'Line: '.$e -> getLine(). '<br>';
}
echo 'complete!';