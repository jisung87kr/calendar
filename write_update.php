<?php
    include_once './include/config.php';

    $post->write($mysqli, $_POST['author'], $_POST['title'], $_POST['content'], $_POST['start_date'], $_POST['end_date'], $_POST['m'], $_POST['id']);
    header("Location:./view.php?id=".$post->insert_id);
?>
