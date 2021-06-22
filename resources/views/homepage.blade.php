
<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <title>首页</title>
    <script type="text/javascript" src="{{URL::asset('js/jquery-3.6.0.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/homepage.css')}}">
</head>
<style type="text/css">
    table.imagetable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #999999;
        border-collapse: collapse;
    }
    table.imagetable th {
        background:#b5cfd2;
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #999999;
    }
    table.imagetable td {
        background:#dcddc0;
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #999999;
    }
    button{
        width:150px;height: 40px;background-color: darkcyan;color:#fff;border-radius: 5px;padding: 0px;border:0px;font-weight: bold;
    }
</style>
<body style="background:url({{URL::asset('upload/background.jpg')}})">
<div style="text-align:center;margin:50px;">
    <div class="top" style="margin: 50px;">
        <div style="margin: 50px;"><h2>{{$data['name']}},欢迎进入系统主页</h2><a href="/loginout">注销</a></div>
    </div>
    <div style="margin: 30px;">
        <button class="newSelect">新的预定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="siginDo">签到页面</button>
    </div>
    <div style="text-align: center;">
        <div style="margin: 30px;"><h3 class="fav_list_title_h3">预定列表</h3></div>
        <table class="imagetable" style="width:50%;margin:auto;">
            <tr>
                <th>预定时间</th><th>签到状态</th><th>邀请码</th><th>完成登记的时间</th><th>操作</th>
            </tr>
            @foreach($data['data'] as $k=>$v)
                @if($v['status_']==1)
                    <tr>
                        <td>{{$v['sign_time']}}</td><td>{{$v['status']}}</td><td>{{$v['check_code']}}</td><td>{{$v['sign_over_time']}}</td><td><button style="width:100px;height: 20px;" class="quxiao" ac_id="{{$v['id']}}">取消</button></td>
                    </tr>
                @else
                    <tr>
                        <td>{{$v['sign_time']}}</td><td>{{$v['status']}}</td><td>{{$v['check_code']}}</td><td>{{$v['sign_over_time']}}</td><td></td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>
</body>
</html>
<script>
    $(".newSelect").click(function(){
        window.location.href='/select';
    })
    $(".siginDo").click(function(){
        window.location.href='/siginPage';
    })
    $(".quxiao").click(function(){
        if(confirm('Are you sure about the cancellation？')){
            var id = $(this).attr('ac_id');
            $.post('/quxiao',{id:id},function (res){
                if(res.code==200){
                    alert(res.msg);
                    window.location.href='/HomePage';
                }else{
                    alert(res.msg);
                    return false;
                }
            })
        }
    })
</script>
