<?php include_once "./include/head.php"  ?>
<?php
$post->getPost($mysqli, $_GET['id']);
 ?>
         <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $post->title?></h3>
                    <div class="author">author : <?php echo $post->author?></div>
                    <div class="date">
                        <span>기간 : </span>
                        <span><?php echo $post->start_date?></span>
                        <span> ~ </span>
                        <span><?php echo $post->end_date?></span>
                    </div>
                </div>
                <div class="panel-body"><?php echo $post->content?></div>
                <div class="panel-footer">
                    <a href="#" class="btn btn-default">수정</a>
                    <a href="./" class="btn btn-primary">목록</a>
                </div>
            </div>
         </div>
<?php include_once "./include/footer.php"  ?>
