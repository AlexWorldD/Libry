<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.12.2015
 * Time: 22:49
 */
include_once 'login_config.php';
// login - SELECT, INSERT  only.
$mysqli = mysqli_connect('localhost', USER_Login, PASSWORD_Login , DATABASE);
if (mysqli_connect_errno()) {
    die('Can\'t connect: ' . mysqli_connect_error());
}
else
{
    mysqli_query($mysqli, "SET NAMES utf8");
}
