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
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Library">
    <title>My books</title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="Bootstrap3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="js/easyui/icon.css">
    <link href="Bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Lekton:700' rel='stylesheet' type='text/css'>
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/jQuery-Autocomplete/styles.css" rel="stylesheet">
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
                <a href="index.php">Main</a>
            </li>
            <li>
                <a href="#">My books</a>
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
                    <h2 class="text-center">My Books <span class="glyphicon glyphicon-home" aria-hidden="true">
                    </h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <div class="text-right">
                                <div class="row">
                                    <button type="button" class="btn  btn-link"
                                            onclick="add_book(<?php echo htmlentities($_SESSION['user_id']); ?>)">Add
                                        <span class="glyphicon glyphicon-plus"></span></button>
                                    <a href="db_connection/get_xml.php?user_id=<?php echo htmlentities($_SESSION['user_id']); ?>"> XML export </a>
                                    <button type="button" class="btn  btn-link btn-xs"
                                            onclick="del_book(<?php echo htmlentities($_SESSION['user_id']); ?>)">Delete
                                        <span class="glyphicon glyphicon-trash"></span></button>
                                </div>
                            </div>

                        </div>
                        <div class="panel-body">
                            <table id="t_my_books" class="easyui-datagrid" style="height:550px"
                                   data-options="url: 'db_connection/load_my_books.php?user_id=<?php echo htmlentities($_SESSION['user_id']); ?>',
                                   striped: 'true',
                                   toolbar: 'toolbar', pagination: 'true',
                                   rownumbers: 'true', fitColumns: 'true', singleSelect: 'true'"
                            >
                                <thead>
                                <tr>
                                    <th field="writing_id" width="0" hidden="true"></th>
                                    <th field="book_id" width="0" hidden="true"></th>
                                    <th field="title" width="35%" align="center">Название</th>
                                    <th field="last_name" width="15%" sortable="true">Автор</th>
                                    <th field="first_name" width="20" align="center"></th>
                                    <th field="patronymic" width="20%"></th>
                                    <th field="page_num" width="10%" align="center" sortable="true" order="desc">
                                        Страниц
                                    </th>
                                </tr>
                                </thead>
                            </table>
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
                                <h4 class="modal-title text-center"><em><span id="l_n"></span> &nbsp <span
                                            id="f_n"></span> &nbsp <span id="pat"></span></em></h4>
                            </div>

                        </div>
                    </div>
                    <div class="modal-header">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">
                                <h4 class="modal-title text-center"><span id="title_book"> </span> <span> &nbsp <span
                                            class="text-muted" id="release_y"></span> </span></h4>
                            </div>

                        </div>
                    </div>
                    <div class="modal-body text-justify" id="descrip_book">
                    </div>
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
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- SECOND MODAL WINDOW -->
        <!-- Modal -->
        <div class="modal fade" id="add_book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="row text-center">
                                <h4>Добавить книгу</h4>
                            </div>

                        </div>
                    </div>
                    <div id="add_success" class="alert alert-success alert-dismissable text-center" hidden>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Книга добавлена!
                    </div>
                    <div id="b_msg_war" class="alert alert-warning alert-dismissable text-center" hidden>
                        <button type="add_fail" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Something went wrong... We are grazy upset...
                    </div>
                    <div class="modal-body text-justify">
                        <form >
                            <div class="panel panel-default">
                                <div class="panel-heading text-left">Основная информация
                                    <!--
                                <button type="button" class="btn btn-default"
                                        onclick="load_user(<?php echo htmlentities($_SESSION['user_id']); ?>)">Put
                                </button>
                                -->
                                </div>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12 col-xs-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">Название</span>
                                                <input type="text" class="form-control" id="title" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">Описание</span>
                                                <textarea class="form-control vresize" rows="5" id="a_desc"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="no_title" class="alert alert-warning alert-dismissable text-center" hidden>
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                        Данной книги нет в нашей библиотеке! Пожалуйста, заполните дополнительную
                                        информацию:
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <br>

                            <div class="panel panel-default">
                                <div class="panel-heading text-left">Об авторе
                                    <!--
                                <button type="button" class="btn btn-default"
                                        onclick="load_user(<?php echo htmlentities($_SESSION['user_id']); ?>)">Put
                                </button>
                                -->
                                </div>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">Автор</span>
                                                <input type="text" class="form-control" id="add_l_n" placeholder="Фамилия"/>
                                                <input type="text" class="form-control" id="add_f_n" placeholder="Имя"/>
                                                <input type="text" class="form-control" id="add_pat"
                                                       placeholder="Отчество/Второе имя"/>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">Год рождения</span>
                                                <input type="text" class="form-control" id="a_y_born"  data-validation="date" data-validation-format="yyyy"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">Страна</span>
                                                <input type="text" class="form-control" id="a_country"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">Год смерти</span>
                                                <input type="text" class="form-control" id="a_y_death"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="panel panel-default">
                                <div class="panel-heading text-left">Дополнительно
                                    <!--
                                <button type="button" class="btn btn-default"
                                        onclick="load_user(<?php echo htmlentities($_SESSION['user_id']); ?>)">Put
                                </button>
                                -->
                                </div>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-6 col-xs-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">Оригинальный язык</span>
                                                <input type="text" class="form-control" id="a_lang_orig"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">Язык книги</span>
                                                <input type="text" class="form-control" id="a_lang"/>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-6 col-xs-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">Количество страниц</span>
                                                <input type="text" class="form-control" id="a_page"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">Год выхода</span>
                                                <input type="text" class="form-control" id="a_year"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary" id="bts"
                                                    onclick="save_book(<?php echo htmlentities($_SESSION['user_id']); ?>)">
                                                Сохранить
                                            </button>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-link" id="btc"
                                                    onclick="cancel_book()" >
                                                Отмена
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
