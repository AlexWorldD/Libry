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
$city = $_POST['city'];
$country = $_POST['country'];
$address = $_POST['address'];
$address2 = $_POST['address2'];

// Start work with db
mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
mysqli_query($mysqli, 'START TRANSACTION');
// Prepare our request for db
// Add country
$request = $mysqli->prepare("SELECT country_id FROM country where country=?");
$request->bind_param('s', $country);
if (!$request->execute()) {
    mysqli_query($mysqli, 'ROLLBACK;');
    die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
} else {
    //Get language_id for book
    $request->bind_result($country_id);
    $request->fetch();
    $request->close();
    if ($country_id == NULL) {
        $request = $mysqli->prepare('INSERT INTO country (country) VALUES (?)');
        $request->bind_param('s', $country);
        if (!$request->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
        }
        $country_id = mysqli_insert_id($mysqli);
        $request->close();
    }
}
// Get city_id
$request = $mysqli->prepare("SELECT city_id FROM city where country_id=$country_id and city=?");
$request->bind_param('s', $city);
if (!$request->execute()) {
    mysqli_query($mysqli, 'ROLLBACK;');
    die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
} else {
    //Get language_id for book
    $request->bind_result($city_id);
    $request->fetch();
    $request->close();
    if ($city_id == NULL) {
        $request = $mysqli->prepare('INSERT INTO city (city, country_id) VALUES (?, ?)');
        $request->bind_param('si', $city, $country_id);
        if (!$request->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
        }
        $city_id = mysqli_insert_id($mysqli);
        $request->close();
    }
}
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
            die('Select Error (' . $mysqli->errno . ') ' . $mysqli->error);
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
