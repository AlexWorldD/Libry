<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 2:55
 */
include_once "bd_connect_secure.php";
$user_id = intval($_POST['user_id']);
if (isset($_POST['writing_id'])) {
    $writing_id = $_POST['writing_id'];
    $request = "SELECT
    release_year, description, lang
FROM
    writing
        JOIN
    language ON writing.lang_origin = language.language_id WHERE writing_id=$writing_id";
    $data = mysqli_query($mysqli, $request);
    if (!$data) {
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    }
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    if ($user_id != 0) {
        $request2 = "select * from want_read where user_id=$user_id and writing_id=$writing_id";
        $res = mysqli_query($mysqli, $request2);
        // this book not in user wishlist
        if (!$res) {
            array_push($items, (object)array('IN' => false));
        } else {
            array_push($items, (object)array('IN' => true));
        }
        echo json_encode($items);
    }
    else {
        array_push($items, (object)array('IN' => false));
        echo json_encode($items);
    }
}