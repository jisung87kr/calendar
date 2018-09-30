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
                         <?php
                         $list = $post->getList($mysqli);
                         for ($i=0; $i <count($list[0]); $i++) {
                             ?>
                             <tr>
                                 <td><?php echo $list[0][$i]['id']?></td>
                                 <td><a href="./view.php?id="<?php echo $list[0][$i]['id']?>></a><?php echo $list[0][$i]['title']?></td>
                                 <td><?php echo $list[0][$i]['author']?></td>
                                 <td><?php echo $list[0][$i]['start_date']?></td>
                                 <td><?php echo $list[0][$i]['end_date']?></td>
                             </tr>
                             <?php
                         }
                         ?>
                     </tbody>
                 </table>
                 <div class="center-block">
                     <?php echo $list[1] ?>
                 </div>
             </div>
         </div>
<?php include_once "./include/footer.php"  ?>
