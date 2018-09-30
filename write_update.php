<?php
    include_once './include/config.php';

    for ($i=0; $i < 100; $i++) {
        $post->write($mysqli, $_POST['author'], $_POST['title'], $_POST['content'], $_POST['start_date'], $_POST['end_date']);
    }


    header("Location:./view.php?id=".$post->insert_id);
?>
