<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 0:01
 */
include_once 'bd_connect.php';
include_once 'functions.php';

sec_session_start(); // Start secure session

if (isset($_POST['username'], $_POST['p'])) {
    $username = $_POST['username'];
    $password = $_POST['p']; // The hashed password.

    if (login($username, $password, $mysqli) == true) {
        // Login success
        header('Location: ../protected_page.php');
    } else {
        // Login failed
        header('Location: ../error.php');
    }
} else {
    echo 'Invalid Request';
}