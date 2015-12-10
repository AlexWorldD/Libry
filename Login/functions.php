<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.12.2015
 * Time: 23:05
 */
// Crate a secure session
function sec_session_start()
{
    $session_name = 'secure_session_id';
    $http_only = true;
    if (ini_set('session.use_only_cookies', 1) == FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], FALSE, $http_only);
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id();
}
// Login function
function login($username, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT user_id, password, salt FROM user WHERE username = ? LIMIT 1")) {
        $stmt->bind_param('u', $username);
        $stmt->execute();
        $stmt->store_result();
        //Getting variables from result
        $stmt->bind_result($user_id, $db_pass, $salt);
        $stmt->fetch();
        // Checking username and password
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            if ($db_pass == $password) {
                //Password is correct
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                $_SESSION['user_id'] = $user_id;
                $username = preg_replace("/[^a-zA-Z0-9_\\-]+/",
                    "",
                    $username);
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512',
                    $password . $user_browser);
                // Login successful.
                return true;
            } else {
                //password wrong
                return false;
            }
        } else {
            //No user in bd
            return false;
        }
    } else {
        // Can't create statement
        header("Location: ../error.php?err=Database error: cannot prepare statement");
        exit();
    }
}
// Function for checking a session info
function login_check($mysqli) {
    if (isset($_SESSION['user_id'],
        $_SESSION['username'],
        $_SESSION['login_string'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT password
                                      FROM user
                                      WHERE user_id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('id', $user_id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // Yes! You are LOG IN ^_^
                    return true;
                } else {
                    // Not
                    return false;
                }
            } else {
                // Not
                return false;
            }
        } else {
            // Not
            return false;
        }
    } else {
        // Not
        return false;
    }
}
// Special function for clear PHP_SELF return.
function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
