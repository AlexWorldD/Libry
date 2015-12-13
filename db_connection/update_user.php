<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.12.2015
 * Time: 2:51
 */
include_once 'bd_connect_secure.php';
// Getting all vars from _POST.
$user_id = intval($_POST['user_id']);
$f_name = $_POST['first_name'];
$l_name = $_POST['last_name'];
$age = intval($_POST['age']);
$sex = $_POST['sex'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city_id = intval($_POST['city_id']);
$country_id = intval($_POST['country_id']);
$address = $_POST['address'];
$address2 = $_POST['address2'];

// Start work with db
mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
mysqli_query($mysqli, 'START TRANSACTION');
// Prepare our request for db
$request = $mysqli->prepare("UPDATE user SET first_name=?, last_name=?, age=?, sex=?, email=?, phone=? WHERE user_id=?");
$request->bind_param('ssisssi', $f_name, $l_name, $age, $sex, $email, $phone, $user_id);
if (!$request->execute()) {
    mysqli_query($mysqli, 'ROLLBACK;');
    header('Location: ../error.php?err=Registration failure: Update user table');
    exit();
}
$request->close();
$request2 = $mysqli->prepare("SELECT address_id FROM user WHERE user_id=?");
$request2->bind_param('i', $user_id);
if (!$request2->execute()) {
    mysqli_query($mysqli, 'ROLLBACK;');
    header('Location: ../error.php?err=Registration failure: Select address_id');
    exit();
} else {
    //Get address_id for crrent user
    $request2->bind_result($ad_id);
    $request2->fetch();
    //echo json_encode(array('user_ad' => $ad_id));
    $request2->close();


    // Current user already has an address_id
    if ($ad_id !== NULL) {
        //Start update info in address table
        $request3 = $mysqli->prepare("UPDATE `address` SET address=?, address2=?, city_id=? WHERE address_id=?");
        $request3->bind_param('ssii', $address, $address2, $city_id, $ad_id);
        if (!$request3->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            header('Location: ../error.php?err=Registration failure: Update address table');
            exit();
        }
        $request3->close();

    } // Address_id for current user is NULL => Create new row in address table
    else {
        $request4 = $mysqli->prepare('INSERT INTO address (address, address2, city_id) VALUES (?, ?, ?);');
        $request4->bind_param('ssi', $address, $address2, $city_id);
        if (!$request4->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            header('Location: ../error.php?err=Registration failure: Insert new row to address table');
            exit();
        }
        $ad_id = mysqli_insert_id($mysqli);
        $request4->close();
        // Add inserted value id to user table
        $request5 = $mysqli->prepare('UPDATE user SET address_id=? WHERE user_id=?');
        $request5->bind_param('ii', $ad_id, $user_id);
        if (!$request5->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            header('Location: ../error.php?err=Registration failure: Insert address_id to user table');
            exit();
        }
        $request5->close();

    }
}
mysqli_query($mysqli, 'COMMIT;');
echo json_encode(array('OK' => true));
