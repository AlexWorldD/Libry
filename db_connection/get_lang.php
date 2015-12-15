<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 15.12.2015
 * Time: 5:56
 */
include_once "bd_connect_secure.php";

if (isset($_GET['query'])) {
    $str = $_GET['query'];
    // Prepare the statement for our search.
    $request = $mysqli->prepare("SELECT lang as `value`, language_id as data FROM language WHERE lang LIKE ? ORDER BY `value`");
    $str1 = $str . '%';
    $request->bind_param('s', $str1);
    $res = $request->execute();
    if (!$res) {
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    }
    $sugestions = array();

    $res = $request->get_result();

    $sugestions = $res->fetch_all(MYSQLI_ASSOC);
    $re = array('query' => $str, 'suggestions' => $sugestions);
    echo json_encode($re);
}