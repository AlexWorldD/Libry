<?php
include_once 'db_connection/bd_connect.php';
include_once 'db_connection/functions.php';
sec_session_start(); // start secure session
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <link rel="stylesheet" href="styles/main.css" />
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/hash_functions.js"></script>
</head>
<body>
<?php
if (isset($_GET['error'])) {
    echo '<p class="error">Error Logging In!</p>';
}
?>
<form action="db_connection/login_process.php" method="post" name="login_form">
    Username: <input type="text" name="username" />
    Password: <input type="password"
                     name="password"
                     id="password"/>
    <input type="button"
           value="Login"
           onclick="formhash(this.form, this.form.password);" />
</form>
<p>If you don't have a login, please <a href="register.php">register</a></p>
<p>If you are done, please <a href="db_connection/logout.php">log out</a>.</p>
<p>You are currently logged <?php echo $logged ?>.</p>
</body>
</html>