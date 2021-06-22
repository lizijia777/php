<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>活动预订页面</title>
    <script type="text/javascript" src="{{URL::asset('js/jquery-3.6.0.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/homepage.css')}}">
</head>
<style>
    .select_time{
        width: 300px;height: 50px;font-size: 30px;border-radius: 10px;padding: 0px; border: 0px;color: blue;
    }
    button{
        width:150px;height: 40px;background-color: darkcyan;color:#fff;border-radius: 5px;padding: 0px;border:0px;font-weight: bold;
    }
</style>
<body style="background:url({{URL::asset('upload/background.jpg')}})">
<div style="text-align:center;margin:50px;">
    <div class="top">
        <div><h2>欢迎来到活动预约页面</h2></div>
    </div>
    <div style="margin: 100px;">
        <h2 class="setDate">活动日期从{{$start_time}}到{{$end_time}}</h2>
        <span style="font-size:20px;font-weight: bold;">选择一个日期：</span><input class="select_time" type="date" value="" min="{{$check_start_time}}" max="{{$check_end_time}}"/>
    </div>
    <div><button class="start_reservation">开始预定</button></div>
</div>
</body>
</html>
<script type="text/javascript">
    $(".select_time").attr('value',getNowFormatDate);
    function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "-";
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = year + seperator1 + month + seperator1 + strDate;
        return currentdate;
    }
    $(".start_reservation").click(function(){
        var date = $(".select_time").val();
        $.post('/reserve',{date:date},function(res){
            if(res.code==200){
                alert(res.msg);
                window.location.href='/HomePage';
            }else if(res.code==300){
                alert(res.msg);
                window.location.href='/';
            }else{
                alert(res.msg);
                return false;
            }
        })
    })
</script>

