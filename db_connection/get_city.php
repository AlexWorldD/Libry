<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2015
 * Time: 0:46
 */
include_once 'bd_connect_secure.php';
/*
if (isset($_POST['country_id'])){
    $country_id = $_POST['country_id'];
    $data = mysqli_query($mysqli, "SELECT city_id, city FROM city WHERE country_id=".$country_id);
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}
else {
    $data = mysqli_query($mysqli, "SELECT city_id, city FROM city");
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}
*/
if (isset($_GET['query'])) {
    $str = $_GET['query'];
    $country_id=intval($_GET['country_id']);
    // Prepare the statement for our search.
    $request = $mysqli->prepare("SELECT city as `value`, city_id as data FROM city, country WHERE city.country_id=country.country_id and country.country_id=? and city LIKE ? ORDER BY `value`");
    $str1 = $str . '%';
    $request->bind_param('is', $country_id, $str1);
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