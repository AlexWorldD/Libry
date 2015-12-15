<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 15.12.2015
 * Time: 16:04
 */
include_once "bd_connect_secure.php";
// Getting all vars from _POST.
$in = intval($_POST['in']);
$user_id = intval($_POST['user_id']);
$lang = $_POST['lang'];
$pages = intval($_POST['pages']);
// Book already in Libry
if ($in == 1) {
    $writing_id = intval($_POST['writing_id']);
    // Start work with db
    mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
    mysqli_query($mysqli, 'START TRANSACTION');
// Prepare our request for db
    $request = $mysqli->prepare("SELECT language_id FROM language where lang=?");
    $request->bind_param('s', $lang);
    if (!$request->execute()) {
        mysqli_query($mysqli, 'ROLLBACK;');
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    } else {
        //Get language_id for book
        $request->bind_result($lang_id);
        $request->fetch();
        $request->close();
        if ($lang_id !== NULL) {
            //Start update info in address table
            $request = $mysqli->prepare("INSERT INTO book (writing_id, lang, page_num) VALUES (?, ?, ?)");
            $request->bind_param('iii', $writing_id, $lang_id, $pages);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
            }
            $book_id = mysqli_insert_id($mysqli);
            $request->close();
            // Add book to common_books table
            $request = $mysqli->prepare("INSERT INTO common_books (book_id, user_id) VALUES (?, ?)");
            $request->bind_param('ii', $book_id, $user_id);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
            }
            $request->close();

        } // lang_id for current book is NULL => Create new row in language table
        else {
            $request = $mysqli->prepare('INSERT INTO language (lang) VALUES (?)');
            $request->bind_param('s', $lang);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                exit();
            }
            $lang_id = mysqli_insert_id($mysqli);
            $request->close();
            // Add book to book table
            $request = $mysqli->prepare("INSERT INTO book (writing_id, lang, page_num) VALUES (?, ?, ?)");
            $request->bind_param('iii', $writing_id, $lang_id, $pages);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
            }
            $book_id = mysqli_insert_id($mysqli);
            $request->close();
            // Add book to common_books table
            $request = $mysqli->prepare("INSERT INTO common_books (book_id, user_id) VALUES (?, ?)");
            $request->bind_param('ii', $book_id, $user_id);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
            }
            $request->close();

        }
    }
    mysqli_query($mysqli, 'COMMIT;');
    echo json_encode(array('OK' => true));
}
// Writing not in Libry
///////////////////////////////////
if ($in == 0) {
    // Start work with db
    $author_in = intval($_POST['author_in']);
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $lang_o = $_POST['lang_o'];
    $release = intval($_POST['release']);
    mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
    mysqli_query($mysqli, 'START TRANSACTION');
// Prepare our request for db
    // gets language original id
    $request = $mysqli->prepare("SELECT language_id FROM language where lang=?");
    $request->bind_param('s', $lang_o);
    if (!$request->execute()) {
        mysqli_query($mysqli, 'ROLLBACK;');
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    } else {
        //Get language_id for book
        $request->bind_result($lang_o_id);
        $request->fetch();
        $request->close();
        if ($lang_o_id == NULL) {
            $request = $mysqli->prepare('INSERT INTO language (lang) VALUES (?)');
            $request->bind_param('s', $lang_o);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
            }
            $lang_o_id = mysqli_insert_id($mysqli);
            $request->close();
        }
    }
    // gets language id
    $request = $mysqli->prepare("SELECT language_id FROM language where lang=?");
    $request->bind_param('s', $lang);
    if (!$request->execute()) {
        mysqli_query($mysqli, 'ROLLBACK;');
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    } else {
        //Get language_id for book
        $request->bind_result($lang_id);
        $request->fetch();
        $request->close();
        if ($lang_o_id == NULL) {
            $request = $mysqli->prepare('INSERT INTO language (lang) VALUES (?)');
            $request->bind_param('s', $lang);
            if (!$request->execute()) {
                mysqli_query($mysqli, 'ROLLBACK;');
                die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
            }
            $lang_id = mysqli_insert_id($mysqli);
            $request->close();
        }
    }
    // already has 2 language ID. Good )
    //////////
    // Start INSERT to writing table
    $request = $mysqli->prepare("INSERT INTO writing (title, release_year, description, lang_origin) VALUES (?, ?, ?, ?)");
    $request->bind_param('sisi', $title, $release, $desc, $lang_o_id);
    if (!$request->execute()) {
        mysqli_query($mysqli, 'ROLLBACK;');
        die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
    }
    $writing_id = mysqli_insert_id($mysqli);
    $request->close();
    // already has writing_ID.
    // start work with author
    // author in Libry
    if ($author_in==1) {
        $author_id=intval($_POST['author_id']);
        $request = $mysqli->prepare("INSERT INTO author_writing (author_id, writing_id) VALUES (?, ?)");
        $request->bind_param('ii', $author_id, $writing_id);
        if (!$request->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
        }
        $request->close();
    }
    // Required add author to Libry
    if ($author_in==0)
    {

    }

    mysqli_query($mysqli, 'COMMIT;');
    echo json_encode(array('OK' => true));
}
