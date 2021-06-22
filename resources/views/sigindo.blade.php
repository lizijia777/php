<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>签到页面</title>
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}"  />
    <script type="text/javascript" src="{{URL::asset('js/jquery-3.6.0.min.js')}}"></script>
</head>
<body style="background:url({{URL::asset('upload/background.jpg')}})">
<div class="mainbody middle sign_start" style="background-color: lightseagreen;border-radius: 20px;">
    <div class="form-box front" style="background-color: lightseagreen">
        <div style="text-align: center;">
            <h2>请签到</h2>
        </div>
        <div>
            <br>
            <input class="input-normal check_code" type="text" placeholder="Invite code" />
            <input class="input-normal password" type="password" placeholder="password" />
            <br>
            <button class="btn-submit" type="submit">
                <a href="javascript:void(0)" class="loginDo"> 签到</a>
            </button>
            <style>
                a{ text-decoration:none}
            </style>
        </div>
    </div>
</div>
<div class="mainbody middle signover" style="background-color: lightseagreen;border-radius: 20px;display: none;">
    <div class="form-box front" style="background-color: lightseagreen">
        <div style="text-align: center;">
            <h2>签到成功</h2>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div style="text-align: center;">
            <h2 class="welcome"></h2>
        </div>
    </div>
</div>
</body>

</html>
<script type="text/javascript">
    $(".loginDo").click(function(){
        var check_code = $(".check_code").val();
        var password = $(".password").val();
        $.post('/checkCode',{check_code:check_code,password:password},function(t){
            if(t.code!=200){
                alert(t.msg);
                return false;
            }else{
                alert(t.msg);
                $(".welcome").html('Welcome,'+t.data.name+'!');
                $(".signover").show(100);
                $(".sign_start").hide(100);
                sleep(1000);
                $(".check_code").val('');
                $(".password").val('');
                $(".signover").hide(200);
                $(".sign_start").show(200);
            }
        })
    })

    function sleep(numberMillis) {
        var now = new Date();
        var exitTime = now.getTime() + numberMillis;
        while (true) {
            now = new Date();
            if (now.getTime() > exitTime)
                return;
        }
    }
</script>


