<?php

/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 22:50
 */
include_once "bd_connect_secure.php";

if (isset($_GET['query'])) {
    $str = $_GET['query'];
    // Prepare the statement for our search.
    $request = $mysqli->prepare("SELECT last_name as `value`, author_id as data FROM author WHERE last_name LIKE ? ORDER BY `value`");
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
if(isset($_POST['writing_id'])) {
    $writing_id=intval($_POST['writing_id']);
    $data = mysqli_query($mysqli, "SELECT
    author.author_id, last_name, first_name, patronymic
FROM
    author
        JOIN
    author_writing ON author_writing.author_id = author.author_id WHERE writing_id=".$writing_id);
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}
if(isset($_POST['author_id'])) {
    $author_id=intval($_POST['author_id']);
    $data = mysqli_query($mysqli, "SELECT
    author.author_id, first_name, patronymic
FROM
    author
    WHERE author_id=".$author_id);
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}

