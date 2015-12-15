<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 21:30
 */
include_once 'db_connection/bd_connect_secure.php';
include_once 'db_connection/functions.php';
sec_session_start(); // start secure session
?>
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
                <a href="#">
                    Libry
                </a>
            </li>
            <li>
                <div class="welcome">
                    <h4>
                        Welcome, <span id="user"><?php echo htmlentities($_SESSION['username']); ?>!</span>
                    </h4>
                </div>
            </li>
            <li>
                <a href="main.php">Main</a>
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
                           <div class="text-right" >
                               <div class="row">
                                   <button type="button" class="btn btn-primary- btn-link" onclick="">XML export <span class="glyphicon glyphicon-floppy-save"></span></button>
                                   <button type="button" class="btn btn-primary- btn-link" onclick="add_book(<?php echo htmlentities($_SESSION['user_id']); ?>)">Add <span class="glyphicon glyphicon-plus"></span></button>
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

                    <div class="modal-body text-justify">
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
                                            <input type="text" class="form-control" id="title"/>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">Пол</span>
                                            <select type="text" class="form-control" id="sex">
                                                <option></option>
                                                <option value="M">М</option>
                                                <option value="F">Ж</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-1 col-xs-6 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">Возраст </span>
                                            <input type="text" class="form-control" id="age">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
