<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2015
 * Time: 0:01
 */
include_once 'bd_connect_secure.php';
if (isset($_GET['query'])) {
    $str = $_GET['query'];
    // Prepare the statement for our search.
    $request = $mysqli->prepare("SELECT country as `value`, country_id as data FROM country WHERE country LIKE ? ORDER BY `value`");
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
/*
$data = mysqli_query($mysqli, "SELECT country_id, country FROM country");
$items = array();
while ($row=mysqli_fetch_object($data)) {
    array_push($items, $row);
}
echo json_encode($items);
*/