<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.12.2015
 * Time: 2:51
 */
include_once 'bd_connect_secure.php';
// Getting all vars from _POST.
$user_id=$_POST['user_id'];
//$f_name=iconv('UTF-8', 'windows-1251', $_POST['first_name']);
$f_name='Алексей';
$l_name=iconv('UTF-8', 'windows-1251', $_POST['last_name']);
$age=$_POST['age'];
$sex=$_POST['sex'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$city_id=$_POST['city_id'];
$country_id=$_POST['country_id'];
$address=iconv('UTF-8', 'windows-1251', $_POST['address']);
$address2=iconv('UTF-8', 'windows-1251', $_POST['address2']);
// Start work with db
mysqli_query($mysqli, 'SET AUTOCOMMIT=0');
mysqli_query($mysqli, 'START TRANSACTION');
// Prepare our request for db
//$request=$mysqli->prepare('UPDATE user SET first_name=?, last_name=?, age=?, sex=?, email=?, phone=? WHERE user_id=?;');
//$request->bind_param('ssisssi', $f_name, $l_name, $age, $sex, $email, $phone, $user_id);
//$request=$mysqli->prepare('UPDATE user SET first_name="Al", last_name="Mal", age=21, sex="M", email="no", phone="+7" WHERE user_id=?;');
//$request->bind_param('s', $user_id);
// start execution
//$request=mysqli_query($mysqli, 'UPDATE user SET first_name="'.$f_name.'", last_name="'.$l_name.'", age='.$age.', sex="'.$sex.'", email="'.$email.'", phone="'.$phone.'" WHERE user_id='.$user_id);
$str="UPDATE user SET first_name='$f_name', last_name='', age=0, sex='M', email='', phone='' WHERE user_id='$user_id'";
$request=mysqli_query($mysqli, $str);
if (!$request) {
    mysqli_query($mysqli, 'ROLLBACK;');
    echo ($mysqli->error);
    header('Location: ../error.php?err=Registration failure: Update user table');
    exit();
}
$request2=$mysqli->prepare('SELECT address_id FROM user WHERE user_id=?;');
$request2->bind_param('i', $user_id);
$ad_id=$request2->execute();
if(!$ad_id) {
    mysqli_query($mysqli, 'ROLLBACK;');
    header('Location: ../error.php?err=Registration failure: Select address_id');
    exit();
}
else {
    // Current user already had an address_id
    if($ad_id!==NULL) {
        //Start update info in address table
        $request3=$mysqli->prepare('UPDATE address SET
city_id=?,
address=?,
address2=? WHERE address_id=?;');
        $request3->bind_param('ssss', $city_id, $address, $address2, $ad_id);
        if (!$request3->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            header('Location: ../error.php?err=Registration failure: Update address table');
            exit();
        }
    }
    // Address_id for current user is NULL => Create new row in address table
    else {
        $request4=$mysqli->prepare('INSERT INTO address (address, address2, city_id) VALUES (?, ?, ?);');
        $request4->bind_param(ssi, $address, $address2, $city_id);
        if (!$request4->execute()) {
            mysqli_query($mysqli, 'ROLLBACK;');
            header('Location: ../error.php?err=Registration failure: Insert new row to address table');
            exit();
        }
    }
}
// if everthing OK => Commit
if($request and $request2 and $request3 and $request4) {
    mysqli_query($mysqli, 'COMMIT;');
    echo json_encode(array('OK'=>true));
} else {
    mysqli_query($mysqli,"ROLLBACK");
    echo json_encode(array('OK'=>false, 'msg'=>'Some errors here. Sorry!'));
}
