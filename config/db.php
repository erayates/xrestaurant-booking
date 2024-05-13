<?php

$db['db_host'] = '127.0.0.1';
$db['db_user'] = 'root';
$db['db_pwd'] = '';
$db['db_name'] = 'xresto';

if (!defined('DB_HOST')) {
    define('DB_HOST', $db['db_host']);
    define('DB_USER', $db['db_user']);
    define('DB_PWD', $db['db_pwd']);
    define('DB_NAME', $db['db_name']);
}


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
// if ($conn) {
//     echo "DB connected.";
// } else {
//     echo "DB was not connected.";
// }
