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
    <meta charset="UTF-8">
    <title>Login page</title>
    <link href="Bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/login_style.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="Bootstrap3/dist/js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/hash_functions.js"></script>
</head>
<body>
<?php
if (isset($_GET['error'])) {
    echo '<p class="error">Error Logging In!</p>';
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign In</h1>
            <div class="account-wall">
                <form class="form-signin" action="db_connection/login_process.php" method="post" name="login_form">
                    <input type="text" class="form-control" placeholder="Username" required autofocus name="username">
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                    <input type="button" class="btn btn-lg btn-primary btn-block"
                           value="Login"
                           onclick="formhash(this.form, this.form.password);" />
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="register2.php" class="text-center new-account">Register </a>
        </div>
    </div>
</div>
</body>
</html>