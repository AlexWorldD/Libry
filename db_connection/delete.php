<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 15.12.2015
 * Time: 20:07
 */
include_once "bd_connect_secure.php";
$user_id = intval($_POST['user_id']);
$book_id = intval($_POST['book_id']);
// Start work with db
mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
mysqli_query($mysqli, 'START TRANSACTION');
$request = $mysqli->prepare("DELETE FROM common_books WHERE user_id=? AND book_id=?");
$request->bind_param('ii', $user_id, $book_id);
if (!$request->execute()) {
    mysqli_query($mysqli, 'ROLLBACK;');
    die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
} else {
    mysqli_query($mysqli, 'COMMIT;');
    echo json_encode(array('OK' => true));
}