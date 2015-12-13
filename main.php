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
                        Welcome, <span id="user"><?php echo htmlentities($_SESSION['username']); ?>!</span>
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
        <div class="container-fluid col-md-10 col-md-offset-1 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-md-offset-6 col-xs-6 col-xs-offset-6">
                    <h1 class="text-center">Profile <button type="button" class="btn btn-link"
                                                            onclick="edit_user()"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
                        </button></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Персональная информация
                            <button type="button" class="btn btn-default"
                                    onclick="load_user(<?php echo htmlentities($_SESSION['user_id']); ?>)">Put
                            </button>
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
                                        <input type="text" class="form-control"  id="age" disabled>
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
                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Страна</span>
                                        <select type="text" class="form-control" id="country" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 col-xs-6 col-md-offset-1">
                                    <div class="input-group">
                                        <span class="input-group-addon">Город</span>
                                        <select type="text" class="form-control" id="city" disabled>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Адрес</span>
                                        <input type="text" class="form-control"  id="address" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-1 col-xs-6 col-md-offset-1">
                                    <div class="input-group">
                                        <span class="input-group-addon">Адрес (доп.)</span>
                                        <input type="text" class="form-control"  id="address2" disabled>
                                    </div>
                                </div>
                            </div>
<!--
                                <div class="col-md-5 col-md-offset-1" id="user_ad">
                                    <address id="address">
                                    </address>
                                </div>
-->
                                <!--Edited field for address -->
                                <!--
                                <div class="col-md-5 col-md-offset-1" id="user_ad_ed">
                                   <div class="row" >
                                       <form class="form-horizontal" role="form" method="post">
                                           <div class="form-group">
                                                       <label>Страна:</label>
                                                       <input id="country" class="easyui-combobox" name="state" style="width:150px;" data-options="valueField:'country_id',textField:'country',url:'db_connection/get_country.php',method:'get',
                                onSelect: function(){
                                if (!this.disabled) {
                                loadcity($('#country').combobox('getValue'));
                                }}">
                                                       <label>Город:</label>
                                                       <input id="city" class="easyui-combobox" name="state" style="width:110px;">
                                           </div>
                                       </form>
                                </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Адрес</span>
                                        <input type="text" class="form-control"  id="user_address">
                                    </div>
                                    -->
                        </div>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="btn-group btn-group-justified" role="group" aria-label="..." >
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" id="bts" onclick="user_save(<?php echo htmlentities($_SESSION['user_id']); ?>)" disabled>Сохранить</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-link" id="btc" onclick="user_cancel(<?php echo htmlentities($_SESSION['user_id']); ?>)" disabled>Отмена</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>



        </div>

        <!--
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
        -->
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
