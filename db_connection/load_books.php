<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.12.2015
 * Time: 21:29
 */
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
include_once "bd_connect_secure.php";
$tmp = mysqli_query($mysqli, "SELECT count(*) FROM writing");
if (!$tmp) {
    header('Location: ../error.php?err=Load failure: number of books');
    exit();
}
// Get TOTAL nums of rows in our table.
$result['total'] = mysqli_fetch_row($tmp)[0];
$request = mysqli_query($mysqli, "SELECT writing.writing_id,
    title, last_name, first_name, patronymic, numbers
FROM
    writing
        JOIN
    author_writing
        JOIN
    author ON writing.writing_id = author_writing.writing_id
        AND author_writing.author_id = author.author_id $sorting LIMIT $offset,$n_rows");
if (!$request) {
    die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    header('Location: ../error.php?err=Load failure: books');
    exit();
}
$items = array();
while ($row = mysqli_fetch_object($request)) {
    array_push($items, $row);
}
$result['rows'] = $items;
echo json_encode($result);
