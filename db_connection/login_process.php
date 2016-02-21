<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 0:01
 */
$mysqli;
include_once 'bd_connect.php';
include_once 'functions.php';
$er_msg=""; // message for login errors
sec_session_start(); // Start secure session
if (isset($_POST['username'], $_POST['p'])) {
    $username = $_POST['username'];
    $password = $_POST['p']; // The hashed password.
    if (login($username, $password, $mysqli) ==TRUE) {
        // Login success
        header('Location: ../index.php');
    } else {
        // Login failed
        $er_msg="Login falled!";
        header('Location: ../index.php');
    }
} else {
    echo 'Invalid Request';
}