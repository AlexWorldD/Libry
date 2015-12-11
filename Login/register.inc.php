<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 0:20
 */
include_once 'bd_connect.php';
include_once 'login_config.php';
$error_msg = "";
if (isset($_POST['username'], $_POST['f_name'], $_POST['l_name'],$_POST['email'], $_POST['p'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $f_name = filter_input(INPUT_POST, 'f_name', FILTER_SANITIZE_STRING);
    $l_name = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">Invalid email!</p>';
    }

    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed password should be 128 characters long.
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    $prep_stmt = "SELECT user_id FROM user WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // User with this username has already registered
            $error_msg .= '<p class="error">A user with this username already exists.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }

    if (empty($error_msg)) {
        // Random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        // Create salted password
        $password = hash('sha512', $password . $random_salt);
        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO user (username, first_name, last_name, email, password, salt) VALUES (?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssss', $username, $f_name, $l_name, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
                exit();
            }
        }
        header('Location: ./register_success.php');
        exit();
    }
}