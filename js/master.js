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
