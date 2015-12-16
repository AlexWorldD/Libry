<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 21:30
 */
include_once 'db_connection/bd_connect.php';
include_once 'db_connection/functions.php';
sec_session_start(); // start secure session
?>
<?php if (login_check($mysqli) == true) :
    mysqli_close($mysqli);
    include_once 'db_connection/bd_connect_secure.php';?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Library">
    <title>Profile</title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="Bootstrap3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="js/easyui/icon.css">
    <link href="Bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/jQuery-Autocomplete/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lekton:700' rel='stylesheet' type='text/css'>
    <link href="css/sidebar.css" rel="stylesheet">
    <script type="text/javascript" src="js/easyui/jquery_easy_ui.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
    <script type="text/JavaScript" src="js/jQuery-Autocomplete/jquery.autocomplete.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css"> -->
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/loadcity.js"></script>
    <script type="text/JavaScript" src="js/load_user.js"></script>
    <script type="text/JavaScript" src="js/edit_user.js"></script>
    <script type="text/JavaScript" src="js/user_functions.js"></script>
    <script type="text/JavaScript" src="js/hash_functions.js"></script>

</head>
<body>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <h3 id="libry">Libry</h3>
            </li>
            <li>
                <div class="welcome">
                    <h4>
                        Welcome, <span id="user"><?php echo htmlentities($_SESSION['username']); ?>!</span>
                    </h4>
                </div>
            </li>
            <li>
                <a href="index.php">Main</a>
            </li>
            <li>
                <a href="mybooks.php">My books</a>
            </li>
            <li>
                <a href="favorite.php">Favorites</a>
            </li>
            <li>
                <a href="books.php">Libry's books</a>
            </li>
            <li>
                <a href="#">My rentals</a>
            </li>
            <li>
                <a href="#">Profile</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid col-md-10 col-md-offset-1 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-md-offset-6 col-xs-6 col-xs-offset-6">
                    <h1 class="text-center">Profile
                        <button type="button" class="btn btn-link"
                                onclick="edit_user()"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
                        </button>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Персональная информация
                            <!--
                            <button type="button" class="btn btn-default"
                                    onclick="load_user(<?php echo htmlentities($_SESSION['user_id']); ?>)">Put
                            </button>
                            -->
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Имя</span>
                                        <input type="text" class="form-control" placeholder="" id="f_name" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 ">
                                    <div class="input-group">
                                        <span class="input-group-addon">Фамилия</span>
                                        <input type="text" class="form-control" placeholder="" id="l_name" disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Пол</span>
                                        <select type="text" class="form-control" id="sex" disabled>
                                            <option></option>
                                            <option value="M">М</option>
                                            <option value="F">Ж</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 col-xs-6 col-md-offset-1">
                                    <div class="input-group">
                                        <span class="input-group-addon">Возраст </span>
                                        <input type="text" class="form-control" id="age" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Contact info tab -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Контактная информация</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="" id="email" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 ">
                                    <div class="input-group">
                                    <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-phone"></span></span>
                                        <input type="text" class="form-control" placeholder="" id="phone" disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <!-- TODO Change select to combobox for city and country -->
                            <!-- TODO Look autocomplete for address in one input http://habrahabr.ru/post/214945/ -->
                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Страна</span>
                                        <input type="text" class="form-control" id="country" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 col-xs-6 col-md-offset-1">
                                    <div class="input-group">
                                        <span class="input-group-addon">Город</span>
                                        <input type="text" class="form-control" id="city" disabled/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Адрес</span>
                                        <input type="text" class="form-control" id="address" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 col-xs-6 col-md-offset-1">
                                    <div class="input-group">
                                        <span class="input-group-addon">Адрес (доп.)</span>
                                        <input type="text" class="form-control" id="address2" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" id="bts"
                                    onclick="user_save(<?php echo htmlentities($_SESSION['user_id']); ?>)" disabled>
                                Сохранить
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-link" id="btc"
                                    onclick="user_cancel(<?php echo htmlentities($_SESSION['user_id']); ?>)" disabled>
                                Отмена
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /#page-content-wrapper -->
    <script type="text/javascript">
        $(document).ready(function() {
            load_user(<?php echo htmlentities($_SESSION['user_id']); ?>)
        })
    </script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</div>
</body>
</html>
<?php else : ?>
    <?php
include_once 'db_connection/bd_connect.php';
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
                <form class="form-signin" action="db_connection/login_process.php" method="post" name="login_form">
                    <input type="text" class="form-control" placeholder="Username" required autofocus name="username">
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                    <input type="button" class="btn btn-lg btn-primary btn-block"
                           value="Login"
                           onclick="formhash(this.form, this.form.password);" />
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="register.php" class="text-center new-account">Register </a>
        </div>
    </div>
</div>
</body>
</html>
<?php endif; ?>

