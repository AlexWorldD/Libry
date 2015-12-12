<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2015
 * Time: 0:46
 */
include_once 'bd_connect_secure.php';
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