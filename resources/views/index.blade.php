<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>登陆注册</title>
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}"  />
<script type="text/javascript" src="{{URL::asset('js/jquery-3.6.0.min.js')}}"></script>
</head>
<body style="background:url({{URL::asset('upload/background.jpg')}})">
<div class="mainbody middle" style="background-color: lightseagreen;border-radius: 20px;">
    <div class="form-box front" style="background-color: lightseagreen">
        <div style="text-align: center;">
            <h2>请登录</h2>
        </div>
        <div>
            <input class="input-normal username" type="text" placeholder="username" />
            <input class="input-normal password" type="password" placeholder="password" />
            <button class="btn-submit" type="submit">
                <a href="javascript:void(0)" class="loginDo"> 登陆</a>
            </button>
            <style>
                a{ text-decoration:none}
            </style>
        </div>
        <div>
            <p style="margin-top: 40px">如果你没有账户.请</p>
            <p>点击这里 <a id="signup">注册</a></p>
            <script type="text/javascript">
                $("#signup").click(function() {
                    $(".middle").toggleClass("middle-flip");
                });


            </script>

        </div>
    </div>
    <div class="form-box back" style="background-color: lightseagreen;height: 500px;">
        <div style="text-align: center;">
            <h2>请注册</h2>
        </div>
        <div>
            <input class="input-normal re_username" type="text" placeholder="username" />
            <input class="input-normal re_email" type="text" placeholder="email" />
            <input class="input-normal re_password" type="password" placeholder="password" />
            <input class="input-normal re_check_password" type="password" placeholder="confirm password" />
            <button class="btn-submit registerDo" type="submit">
                注册
            </button>
        </div>
        <div>
            <p style="margin-top: 40px">有账户 ? 你可以</p>
            <p>点击这里 <a id="login">登陆</a></p>
            <script type="text/javascript">

                // 点击login触发翻转样式
                $("#login").click(function() {
                    $(".middle").toggleClass("middle-flip");
                });

            </script>

        </div>
    </div>
</div>
</body>
</body>

</html>
<script type="text/javascript">
    $(".loginDo").click(function(){
        var username = $(".username").val();
        var password = $(".password").val();
        $.post('/login',{username:username,password:password},function(t){
            if(t.code!=200){
                alert(t.msg);
                return false;
            }else{
                alert(t.msg);
                window.location.href='/HomePage';
            }
        })
    })
    $(".registerDo").click(function(){
        var username = $(".re_username").val();
        var email = $(".re_email").val();
        var password = $(".re_password").val();
        var check_password = $(".re_check_password").val();
        var reg = /^[A-Za-z0-9_]{6,16}$/;
        var email_check = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        var pass_check = /^\S{6,}$/;
        if(!reg.test(username)){
            alert("用户名6-16位数字，只能输入字母数字下划线!");
            return false;
        }
        if(!email_check.test(email)){
            alert("邮箱格式不正确!");
            return false;
        }
        if(!pass_check.test(password)){
            alert("密码至少6个字符!");
            return false;
        }
        if(password !== check_password){
            alert("两个密码不匹配!");
            return false;
        }
        $.post('/register',{username:username,password:password,email:email},function (res){
            if(res.code!=200){
                alert(res.msg);
                return false;
            }else{
                alert(res.msg);
                window.location.href='/';
            }

        });
    })
    //$.post（
</script>

