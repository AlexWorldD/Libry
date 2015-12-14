<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 15:36
 */
include_once "bd_connect_secure.php";
if (isset($_POST['user_id'], $_POST['writing_id'])) {
    $user_id = intval($_POST['user_id']);
    $writing_id = intval($_POST['writing_id']);
    // Start work with db
    mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
    mysqli_query($mysqli, 'START TRANSACTION');
    /*
    $request = $mysqli->prepare("INSERT INTO want_read VALUES (?, ?)");
    $request->bind_param('ii', $user_id, $writing_id);
    */
    $request = "INSERT INTO want_read VALUES ($user_id, $writing_id)";
    $result = mysqli_query($mysqli, $request);
    $er = $mysqli->errno;
    if ($er == 1062) {
        mysqli_query($mysqli, 'ROLLBACK;');
        echo json_encode(array('OK' => false, 'error' => $er));
        exit();
    } else {
        if (!$result) {
            mysqli_query($mysqli, 'ROLLBACK;');
            echo json_encode(array('OK' => 'no', 'error' => $er));
            exit();
        }
        echo json_encode(array('OK' => true));
        mysqli_query($mysqli, 'COMMIT;');
    }

}