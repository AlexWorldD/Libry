<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 17:39
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
$tmp = mysqli_query($mysqli, "SELECT count(*) FROM common_books WHERE user_id=$user_id");
if (!$tmp) {
    header('Location: ../error.php?err=Load failure: number of favorite books');
    exit();
}
// Get TOTAL nums of rows in our table.
$result['total'] = mysqli_fetch_row($tmp)[0];
$request = mysqli_query($mysqli, "SELECT
    t1.writing_id,
    t1.book_id,
    title,
    last_name,
    first_name,
    patronymic,
    page_num
FROM
    (SELECT
        writing_id, common_books.book_id, page_num
    FROM
        book
    JOIN common_books ON book.book_id = common_books.book_id
    WHERE
        user_id = $user_id) AS t1 JOIN writing
        JOIN
    author_writing
        JOIN
    author ON  t1.writing_id=writing.writing_id AND t1.writing_id = author_writing.writing_id
        AND author_writing.author_id = author.author_id $sorting LIMIT $offset,$n_rows");
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