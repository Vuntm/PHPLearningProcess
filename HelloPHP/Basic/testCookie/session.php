<?php
session_start();

$_SESSION['username'] = 'vuntm';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';