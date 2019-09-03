<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/jquery.js"></script>
    <title>注册</title>
</head>
<body>
<div align="center">
    <h2>注册页面</h2>   <h3><a href="{{url('user/log')}}">登录</a></h3>
    <form action="{{url('user/login_do')}}" method="post" id="myform">
        @csrf
        <table>
            用户名：<input type="text" name="name"> <br>
            密码：<input type="password" name="pwd"> <br>
            验证码：<input type="text" name="code"> <button class="button">获取</button>
            <br>
            <input type="submit" value="注册">
        </table>
    </form>
</div>
</body>
</html>
<script>
    $(function(){
        $('.button').click(function(){
          $.get("{{url('user/code')}}",function(res){
              alert(res.msg);
          },'json');

        return false;
        });
    $('#myform').submit(function(){
          var data=$('#myform').serialize();
        $.post("{{url('user/login_do')}}",data,function(res){
            alert(res.msg);
            if(res.code==1){
                location.href="{{url('user/log')}}";
            }
        },'json');

            return false;
    });

    })
</script>
