<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.12.2015
 * Time: 22:49
 */
// login - SELECT, INSERT and UPDATE only.
$mysqli = new mysqli('bd.localhost', 'login', 'qwerty', 'libry');
if (!$mysqli) {
    die('Can\'t connect: ' . mysqli_connect_error());
}
