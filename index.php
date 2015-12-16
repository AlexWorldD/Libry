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
    <title>Main page</title>
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
    <script type="text/JavaScript" src="js/book_functions.js"></script>

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
                <a href="#">Main</a>
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
                <a href="profile.php">Profile</a>
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
                    <h2 class="text-center">Main <span class="glyphicon glyphicon-th" aria-hidden="true">
                    </h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <div class="row">
                                <div class="col-md-12 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Поиск книги</span>
                                        <input type="text" class="form-control" id="search" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">


                                    <div class="modal-header">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <h4 class="modal-title text-center"><span id="title_book"> </span> <span> &nbsp <span
                                                            class="text-muted" id="release_y"></span> </span></h4>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <h4 class="modal-title text-center"><em><span id="l_n"></span> &nbsp <span
                                                            id="f_n"></span> &nbsp <span id="pat"></span></em></h4>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="modal-body text-justify" id="descrip_book">
                                    </div>
                                    <br>
                                    <div class="modal-footer">


                                        <!--
                        <div class="row">
                            <div id="b_msg" class="alert alert-success alert-dismissable text-center" hidden>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Книга добавлена!
                            </div>
                            <div id="b_msg_war" class="alert alert-warning alert-dismissable text-center" hidden>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Книга уже в вашем списке Favorites!
                            </div>
                            <button type="button" class="btn btn-primary- btn-link" onclick="add_fav(<?php echo htmlentities($_SESSION['user_id']); ?>)">Add to <span class="glyphicon glyphicon-star-empty"></span></button>
                        </div>
                        -->
                                    </div>


                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="m_show_book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">
                                <h4 class="modal-title" ><span id="title_book"> </span> &nbsp; <span id="fav_star"><span class="glyphicon glyphicon-star-empty text-muted" disabled></span></h4>
                                <h4 class="modal-title text-muted" id="release_y"></h4>

                            </div>

                        </div>
                    </div>
                    <div class="modal-body" id="descrip_book">
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div id="b_msg" class="alert alert-success alert-dismissable text-center" hidden>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Книга добавлена!
                        </div>
                            <div id="b_msg_war" class="alert alert-warning alert-dismissable text-center" hidden>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Книга уже в вашем списке Favorites!
                            </div>
                        <button type="button" class="btn btn-primary- btn-link" onclick="add_fav(<?php echo htmlentities($_SESSION['user_id']); ?>)">Add to <span class="glyphicon glyphicon-star-empty"></span></button>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <!-- /#page-content-wrapper -->
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