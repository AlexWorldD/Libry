<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.12.2015
 * Time: 2:51
 */
include_once 'bd_connect_secure.php';
$f_name=iconv('UTF-8', 'windows-1251', $_POST['first_name']);
$l_name=iconv('UTF-8', 'windows-1251', $_POST['last_name']);
$age=$_POST['age'];
$sex=$_POST['sex'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$city_id=$_POST['city_id'];
$country_id=$_POST['country_id'];
$address=iconv('UTF-8', 'windows-1251', $_POST['address']);
$address2=iconv('UTF-8', 'windows-1251', $_POST['address2']);
echo json_encode('Nice');