<?php
function __getDate($date){
    date_default_timezone_set("Asia/Seoul");
    $days = array('일', '월', '화', '수', '목', '금', '토');
    $ymd = date('Y-m-d', strtotime($date));
    $y = date('Y', strtotime($date));
    $m = date('n', strtotime($date));
    $j = date('j', strtotime($date));
    $dayOfMonth = date('w', mktime(0, 0, 0, $m, 1, $y));
    $monthLength = date('t', strtotime($ymd));
    $lastDayOfMonth = date('w', mktime(0, 0, 0, $m, $monthLength, $y));
    $dayOfTheWeek = date('w', strtotime($ymd));
    $startWeek = date('Y-m-d', strtotime($ymd." -".$dayOfTheWeek." day"));
    $lastWeek = date('Y-m-d', strtotime($startWeek.' +6 day'));
    $totalWeek = ceil(($monthLength+$dayOfMonth)/7);
    $dateArr = [
        "y" => $y,
        "m" => $m,
        "d" => $j,
        "dayOfMonth" => $dayOfMonth,
        "dayOfMonth_ko" => $days[$dayOfMonth],
        "lastDayOfMonth" => $lastDayOfMonth,
        "lastDayOfMonth_ko" => $days[$lastDayOfMonth],
        "monthLength" => $monthLength,
        "dayOfWeek" => $dayOfTheWeek,
        "dayOfWeek_ko" => $days[$dayOfTheWeek],
        "startWeek" => $startWeek,
        "lastWeek" => $lastWeek,
        "ymd" => $ymd,
        "totalWeek" => $totalWeek
    ];

    return $dateArr;
}

if(isset($_GET['ymd'])){
    $date = __getDate($_GET['ymd']);
} else {
    $date = __getDate(date("Ymd"));
}
 ?>

<div class="calendar">
    <div class="text-center cal-head">
        <div class="wrapper">
            <?php
            $prev = date("Ymd", strtotime($date['ymd']." -1 month"));
            $next = date("Ymd", strtotime($date['ymd']." +1 month"));
            ?>
            <input type="button" name="ymd" value="이전달" data-month="<?php echo $prev?>" class="btn">
            <h1><?php echo $date['y'].'년 '.$date['m']."월"?></h1>
            <input type="button" name="ymd" value="다음달" data-month="<?php echo $next?>" class="btn">
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><span class="sun">일</span></th>
                <th><span class="normal">월</span></th>
                <th><span class="normal">화</span></th>
                <th><span class="normal">수</span></th>
                <th><span class="normal">목</span></th>
                <th><span class="normal">금</span></th>
                <th><span class="sat">토</span></th>
            </tr>
        </thead>
        <tbody>
            <?php

            $day = 1;
            for ($row=1; $row <= $date['totalWeek'] ; $row++) {
                echo "<tr>";
                for ($col=0; $col < 7 ; $col++) {
                    echo "<td>";
                    if( (!($row == 1 && $col < $date['dayOfMonth']) || ($row == $date['totalWeek'] && $col > $date['lastDayOfMonth'])) ){
                        if($day <= $date['monthLength']){
                            if($col == 0){
                               echo "<span class='sun'>";
                            } else if ($col == 6){
                               echo "<span class='sat'>";
                            } else {
                               echo "<span class='normal'>";
                            }

                            $thisDay = $date['y'].$date['m'].$day;
                            if(date("Ynj") == $thisDay){
                                $class = "today";
                            } else {
                                $class = "";
                            }
                            
                            echo "<a href='./write.php?ymd=$thisDay' class='$class'>".$day."</a>";
                            echo "</span>";
                            $day++;
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
             ?>
        </tbody>
    </table>
</div>
