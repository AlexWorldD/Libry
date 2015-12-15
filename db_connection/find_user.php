<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 16.12.2015
 * Time: 1:02
 */
include_once 'bd_connect_secure.php';
if (isset($_POST['writing_id'])){
    $writing_id=intval($_POST['writing_id']);
    $request="select last_name, first_name, phone, email from user, common_books, book where user.user_id=common_books.user_id and common_books.book_id=book.book_id and book.writing_id=$writing_id";
    $data = mysqli_query($mysqli, $request);
    $items = array();
    while ($row = mysqli_fetch_object($data)) {
        array_push($items, $row);
    }
    echo json_encode($items);
}