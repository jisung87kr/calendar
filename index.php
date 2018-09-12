 <!DOCTYPE html>
 <html lang="en" dir="ltr">
     <head>
         <meta charset="utf-8">
         <title>달력</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
         <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         <style media="screen">
             .cal-head>.wrapper{
                display: inline-block;
             }
            .cal-head>.wrapper>*{
                float: left;
                vertical-align: middle;
            }

            .cal-head>.wrapper .btn{
                color: #fff;
                background: #333;
                margin: 20px;
                margin-top: 25px;
                font-size: 12px;
            }

             .sun{
                 color: rgb(242, 59, 44);
             }

             .sat{
                 color : rgb(4, 83, 187);
             }
         </style>
     </head>
     <body>
         <div class="container">

             <div id="calendar"></div>
         </div>
         <script type="text/javascript">
             $(document).ready(function(){
                function getToday(){
                    var date = new Date();
                    var year = date.getFullYear();
                    var month = new String(date.getMonth()+1);
                    var day = new String(date.getDate());

                    if(month.length == 1){
                        month = "0" + month;
                    }
                    if(day.length == 1){
                        day = "0" + day;
                    }

                    return year+'-'+month+'-'+day;
                }

                 function callCalendar(date){
                     $.ajax({
                         url: './calendar.php',
                         type: 'GET',
                         data: {
                             'ymd' : date,
                         },
                         success: function(response) {
                             if($("#calendar").find('.calendar').length != 0){
                                $("#calendar .calendar").remove();
                             }
                             $("#calendar").append(response);
                         },
                         error: function(error){
                             console.log(response);
                         }
                     });
                 }


                 callCalendar(getToday());

                 $("html").on("click", ".cal-head .btn", function(){
                    var date = $(this).attr("data-month");
                    callCalendar(date);
                 });
             });
         </script>
     </body>
 </html>
