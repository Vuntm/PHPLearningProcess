<?php
const _MODULE = 'home';
const _ACTION = 'dashboard';

const _HOST = 'localhost';
const _DB = 'firstDbPHP';
const _USER = 'root';
const _PASSWORD = 'root';

const _CODE = true;

//Thiết lập host
define('_WEB_HOST','http://'. $_SERVER['HTTP_HOST']. '/HelloPHP/DemoManagerUsers/manager_users');
define('_WEB_HOST_TEMPLATES',_WEB_HOST. '/templates');

//Thiết lập đường dẫn
define('_WEB_PATH',__DIR__);
define('_WEB_PATH_TEMPLATES',_WEB_PATH. '/templates');