<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2015
 * Time: 19:35
 */
include_once 'bd_connect_secure.php';
if (isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $request="SELECT first_name, last_name, sex, age, phone, email, country.country_id, country, city.city_id, city, address, address2
FROM user join address join city join country
WHERE user_id=".$user_id." and user.address_id=address.address_id and address.city_id=city.city_id and city.country_id=country.country_id;";
    $data = mysqli_query($mysqli, $request);
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}
else {

    echo 'Invalid request!';
}