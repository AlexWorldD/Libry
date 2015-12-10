<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.12.2015
 * Time: 22:49
 */
// login - SELECT, INSERT and UPDATE only.
$mysqli = new mysqli(HOST, USER_Login, PASSWORD_Login , DATABASE);
if (!$mysqli) {
    die('Can\'t connect: ' . mysqli_connect_error());
}
