<?php
    $mysqli = new Mysqli('localhost', 'calendar', '1183313zZ!', 'calendar');
    if($mysqli->connect_errno){
        die($mysqli->connect_error);
    }
 ?>
