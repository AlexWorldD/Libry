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
    <script type="text/javascript" src="js/easyui/jquery_easy_ui.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>

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
                <a href="#">Main</a>
            </li>
            <li>
                <a href="#">My books</a>
            </li>
            <li>
                <a href="#">Favorites</a>
            </li>
            <li>
                <a href="#">Libry's books</a>
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
                    <h2 class="text-center">Libry's Books <span class="glyphicon glyphicon-book" aria-hidden="true">
                    </h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">

                        <div class="panel-heading">


                        </div>
                        <div class="panel-body">
                            <table id="t_books" class="easyui-datagrid" style="height:550px"
                                   url="db_connection/load_books.php"
                                   striped="true"
                                   toolbar="#toolbar" pagination="true"
                                   rownumbers="true" fitColumns="true" singleSelect="true"
                            >
                                <thead>
                                <tr>
                                    <th field="writing_id" width="0" hidden="true"></th>
                                    <th field="title" width="35%" align="center">Название</th>
                                    <th field="last_name" width="15%" sortable="true">Автор</th>
                                    <th field="first_name" width="20" align="center"></th>
                                    <th field="patronymic" width="20%"></th>
                                    <th field="numbers" width="10%" align="center" sortable="true" order="desc">
                                        Количество
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
                                <h4 class="modal-title" ><span id="title_book"> </span> &nbsp; <span class="glyphicon glyphicon-star-empty text-muted" disabled></h4>
                                <h4 class="modal-title text-muted" id="release_y"></h4>

                            </div>

                        </div>
                    </div>
                    <div class="modal-body" id="descrip_book">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary- btn-link">Add to <span class="glyphicon glyphicon-star-empty"></span></button>
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
