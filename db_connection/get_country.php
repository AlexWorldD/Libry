<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2015
 * Time: 0:01
 */
include_once 'bd_connect_secure.php';
$data = mysqli_query($mysqli, "SELECT country_id, country FROM country");
$items = array();
while ($row=mysqli_fetch_object($data)) {
    array_push($items, $row);
}
echo json_encode($items);