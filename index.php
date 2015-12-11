<?php
include_once 'Login/bd_connect.php';
include_once 'Login/functions.php';

sec_session_start(); // start secure session
?>
<?php if (login_check($mysqli) == true) :
    mysqli_close($mysqli);
    include_once 'Login/bd_connect_secure.php';?>
    <!DOCTYPE html>
    <html>
<head>
    <meta charset="UTF-8">
    <title>Main page</title>
    <link rel="stylesheet" href="styles/main.css" />
</head>
<body>
    <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
    <p>
        This is an example protected page.  To access this page, users
        must be logged in.  At some stage, we'll also check the role of
        the user, so pages will be able to determine the type of user
        authorised to access the page.
    </p>
</body>
</html>
<?php else : ?>
    <?php
    include_once 'login/bd_connect.php';
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
            <title>Sign In</title>
            <link rel="stylesheet" href="styles/main.css" />
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
                    <?php
                    if (!empty($er_msg)) {
                        echo '<h4 class="text-center warning">'.$er_msg.'</h4>';
                    }
                    ?>
                    <form class="form-signin" action="Login/login_process.php" method="post" name="login_form">
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
<?php endif; ?>
