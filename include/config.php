<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $mysqli = new mysqli('localhost', 'calendar', '1183313zZ!', 'calendar');
    if($mysqli->connect_errno){
        die($mysqli->connect_error);
    }

    ////////////////////////////////////////////////
    include_once 'class.php';
    $post = new Schedule('schedules');
 ?>
