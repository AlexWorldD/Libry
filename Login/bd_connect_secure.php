<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 20:18
 */
include_once 'login_config.php';
// USER - SELECT, INSERT, UPDATE and DELETE.
$mysqli = new mysqli(HOST, USER, PASSWORD , DATABASE);
if (!$mysqli) {
    die('Can\'t connect: ' . mysqli_connect_error());
}
