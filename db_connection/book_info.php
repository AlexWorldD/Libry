<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 2:55
 */
include_once "bd_connect_secure.php";
if (isset($_POST['writing_id'])){
    $writing_id = $_POST['writing_id'];
    $request="SELECT
    release_year, description, lang
FROM
    writing
        JOIN
    language ON writing.lang_origin = language.language_id WHERE writing_id=$writing_id";
    $data = mysqli_query($mysqli, $request);
    if(!$data)
    {
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    }
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}