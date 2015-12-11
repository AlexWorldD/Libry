<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 11.12.2015
 * Time: 21:30
 */
include_once 'Login/bd_connect_secure.php';
include_once 'login/functions.php';
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
    <script type="text/JavaScript" src="js/sha512.js"></script>
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
                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                </div>
            </div>
        </div>
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
