<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 15.12.2015
 * Time: 20:39
 */
include_once "bd_connect_secure.php";

$user_id = intval($_POST['user_id']);
///
$result = mysqli_query($mysqli, "SELECT
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
        user_id =$user_id) AS t1 JOIN writing
        JOIN
    author_writing
        JOIN
    author ON  t1.writing_id=writing.writing_id AND t1.writing_id = author_writing.writing_id
        AND author_writing.author_id = author.author_id");
if (!$result) {
    die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
} else {
    $file = fopen("my_books.xml", "w+");
    fputs($file, "<?xml version='1.0'  encoding=\"UTF-8\"?> \n");
    fputs($file, "<myBooks>");
    while ($row = mysqli_fetch_array($result)) {
        fputs($file, "\n");
        fputs($file, "<book>");
        fputs($file, "\n");
        fputs($file, "<id>");
        fputs($file, "\n");
        fputs($file, $row['writing_id']);
        fputs($file, "\n");
        fputs($file, "</id>");
        fputs($file, "\n");
        fputs($file, "<title>");
        fputs($file, "\n");
        fputs($file, $row['title']);
        fputs($file, "\n");
        fputs($file, "</title>");
        fputs($file, "\n");
        fputs($file, "<author>");
        fputs($file, "\n");
        fputs($file, "<last_name>");
        fputs($file, "\n");
        fputs($file, $row['last_name']);
        fputs($file, "\n");
        fputs($file, "</last_name>");
        fputs($file, "\n");
        fputs($file, "<first_name>");
        fputs($file, "\n");
        fputs($file, $row['first_name']);
        fputs($file, "\n");
        fputs($file, "</first_name>");
        fputs($file, "\n");
        fputs($file, "<patronymic>");
        fputs($file, "\n");
        fputs($file, $row['patronymic']);
        fputs($file, "\n");
        fputs($file, "</patronymic>");
        fputs($file, "\n");
        fputs($file, "</author>");
        fputs($file, "\n");
        fputs($file, "<page_number>");
        fputs($file, "\n");
        fputs($file, $row['page_num']);
        fputs($file, "\n");
        fputs($file, "</page_number>");
        fputs($file, "\n");
        fputs($file, "</book>");
    }
    fputs($file, "\n");
    fputs($file, "</myBooks>");
    fclose($file);

    /*
echo '<script type="text/javascript">
        document.location.href = "db_connection/my_books.xml";
      </script>';
*/
    ////

    $f_name = 'my_books.xml';

    if (file_exists($f_name)) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type:  text/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . basename($f_name) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($f_name));
        // читаем файл и отправляем его пользователю
        readfile($f_name);
        exit;
    } else {
        header('Location: ../db_connection/my_books.xml');
        exit();
    }

    //header('Location: ../db_connection/my_books.xml');


}
