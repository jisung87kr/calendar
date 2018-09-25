<?php
    include_once './include/config.php';
    $post = new Schedule('schedules');
    $post->write($mysqli, $_POST['author'], $_POST['title'], $_POST['content'], $_POST['start_date'], $_POST['end_date']);



?>
