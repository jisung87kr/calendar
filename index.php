<?php include_once "./include/head.php"  ?>
         <div class="container-fluid">
            <div class="row">
                <div id="calendar" class="col-sm-6"></div>
                <div class="col-sm-6">
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                    <form class="" action="write_update.php" method="post">
                        <input type="hidden" name="m" value="">
                        <input type="hidden" name="id" value="">
                        <legend>일정을 등록하세요</legend>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th><label for="title">제목</label></th>
                                <td>
                                    <input type="text" name="title" value="" id="title">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="author">작성자</label></th>
                                <td>
                                    <input type="text" name="author" value="" id="author">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="start_date">기간</label></th>
                                <td>
                                    <input type="text" name="start_date" value="" id="start_date" class="datepicker">
                                    <span>~</span>
                                    <input type="text" name="end_date" value="" id="end_date" class="datepicker">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea name="content" rows="8" cols="80"></textarea>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="" value="저장" class="btn btn-primary">
                    </form>
                    <script type="text/javascript">
                    $(document).ready(function(){
                    $(".datepicker").datepicker({
                    dateFormat : "yy-mm-dd",
                    changeMonth: true,
                    dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                    dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                    monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월']
                    });
                    });
                    </script>
                </div>
            </div>
            <a href="list.php" class="btn btn-default">전체 리스트보기</a>
         </div>
<?php include_once "./include/footer.php"  ?>
