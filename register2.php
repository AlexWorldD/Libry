<?php
include_once 'login/register.inc.php';
include_once 'login/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register page</title>
    <link href="Bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/register_style.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="Bootstrap3/dist/js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/hash_functions.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
            <h1 class="text-center login-title">Register</h1>
            <div class="account-wall">
                <?php
                if (!empty($error_msg)) {
                    echo '<h4 class="text-center warning">'.$error_msg.'</h4>';
                }
                ?>
                <form class="form-signin" method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                    <h5 class="pull-left field_names">Username:</h5>
                    <input type="text" class="form-control" placeholder="" required autofocus name="username">
                    <h5 class="pull-left field_names">First Name:</h5><input type="text" class="form-control" placeholder="" required autofocus name="f_name">
                    <h5 class="pull-left field_names">Last Name:</h5><input type="text" class="form-control" placeholder="" required autofocus name="l_name">
                    <h5 class="pull-left field_names">Email:</h5><input type="text" class="form-control" placeholder="example@db.com" required autofocus name="email">
                    <h5 class="pull-left field_names">Password:</h5><input type="password" class="form-control" placeholder="" required name="password">
                    <input type="password" class="form-control" id="confpassword" placeholder="Confirm password" required name="confirmpwd">
                    <input type="button" class="btn btn-lg btn-primary btn-block"
                           value="Register"
                           onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.f_name,
                                   this.form.l_name,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" />
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="login2.php" class="text-center new-account">Sign In </a>
        </div>
    </div>
</div>
</body>
</html>