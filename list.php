<?php include_once "./include/head.php"  ?>
         <div class="container">
             <div class="row">
                 <table class="table table-striped">
                     <colgroup>
                         <col width="">
                     </colgroup>
                     <thead>
                         <tr>
                             <th>번호</th>
                             <th>제목</th>
                             <th>작성자</th>
                             <th>시작일</th>
                             <th>종료일</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td><?php echo $post->id?></td>
                             <td><a href="./view.php?id="<?php echo $post->id?>></a><?php echo $post->title?></td>
                             <td><?php echo $post->author?></td>
                             <td><?php echo $post->start_date?></td>
                             <td><?php echo $post->start_end?></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
<?php include_once "./include/footer.php"  ?>
