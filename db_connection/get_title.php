<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 14.12.2015
 * Time: 22:50
 */
include_once "bd_connect_secure.php";

if (isset($_GET['query'])) {
    $str = $_GET['query'];
    // Prepare the statement for our search.
    $request = $mysqli->prepare("SELECT title as res FROM writing WHERE title LIKE ? ORDER BY res");
    $str1=$str.'%';
    $request->bind_param('s', $str1);
    $res=$request->execute();
    if (!$res) {
        die('Select Error (' .$mysqli->errno . ') ' . $mysqli->error);
    }
    $sugestions=array();

    $res=$request->get_result();

    $sugestions=$res->fetch_all();
    /*
    while ($row = mysqli_fetch_object($res)) {
        array_push($items, $row);
    }

    $res=$request->get_result();
    $items = array();
    $items=$res->fetch_all();
    $response=array('value'=>$items);

    while ($row = $res->fetch)
        array_push($sugestions, $row);
    }
*/
    $c=['Andorra', 'Russia'];
    $re=array('query'=>$str, 'suggestions'=>$sugestions[0]);
   echo json_encode($re);
}