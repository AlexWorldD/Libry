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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Library">
    <title>Main page</title>
    <link href="Bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/sidebar.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="Bootstrap3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="js/easyui/icon.css">
    <script type="text/javascript" src="js/easyui/jquery_easy_ui.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css"> -->
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/loadcity.js"></script>
    <script type="text/JavaScript" src="js/hash_functions.js"></script>
</head>
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
                        Welcome,  <span id="user"><?php echo htmlentities($_SESSION['username']); ?>!</span>
                    </h4>
                </div>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Simple Sidebar</h1>
                </div>
            </div>

        </div>
        <form class="form-horizontal" role="form" method="post">
            <div class="form-group">
                <div class="col-sm-4">
                    <div calss="fitem">
                        <label>Страна:</label>
                        <input id="country" class="easyui-combobox" name="state" style="width:150px;" data-options="valueField:'country_id',textField:'country',url:'db_connection/get_country.php',method:'get',
                        onSelect: function(){
                        loadcity($('#country').combobox('getValue'));
                        }">
                    </div>
                    <div calss="fitem">
                        <label>Город:</label>
                        <input id="city" class="easyui-combobox" name="state" style="width:150px;">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /#page-content-wrapper -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</div>
</body>
</html>
