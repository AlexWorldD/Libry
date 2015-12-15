<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 21:42
 */
include_once "bd_connect_secure.php";
$result = array();
$n_pages = isset($_POST['page']) ? intval($_POST['page']) : 1;
$n_rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
if (isset($_POST['sort'])) {
    $sort = $_POST['sort'];
    $type = $_POST['order'];
    $sorting="ORDER BY $sort $type";
}
else {
    $sorting='';
}
$offset = ($n_pages - 1) * $n_rows;
$user_id=intval($_GET['user_id']);
include_once "bd_connect_secure.php";
$tmp = mysqli_query($mysqli, "SELECT count(*) FROM want_read WHERE user_id=$user_id");
if (!$tmp) {
    header('Location: ../error.php?err=Load failure: number of favorite books');
    exit();
}
// Get TOTAL nums of rows in our table.
$result['total'] = mysqli_fetch_row($tmp)[0];
$request = mysqli_query($mysqli, "select t2.writing_id, title, last_name, first_name, patronymic from (select writing.writing_id, title, last_name, first_name, patronymic FROM writing, author_writing, author WHERE writing.writing_id = author_writing.writing_id
        AND author_writing.author_id = author.author_id) as t1, (SELECT
            want_read.writing_id
        FROM
            writing
                JOIN
            want_read ON writing.writing_id = want_read.writing_id
        WHERE
            user_id = $user_id) as t2
            where t1.writing_id=t2.writing_id $sorting LIMIT $offset,$n_rows");
if (!$request) {
    die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    header('Location: ../error.php?err=Load failure: favorite books');
    exit();
}
$items = array();
while ($row = mysqli_fetch_object($request)) {
    array_push($items, $row);
}
$result['rows'] = $items;
echo json_encode($result);