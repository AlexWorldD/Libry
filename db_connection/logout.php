<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 0:05
 */
include_once 'functions.php';
sec_session_start();

$_SESSION = array();

$params = session_get_cookie_params();

setcookie(session_name(),
    '', time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["http_only"]);

// Kill session
session_destroy();
header('Location: ../ index.php');