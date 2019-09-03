<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/jquery.js"></script>
    <title>登录视图</title>
</head>
<body>
<div align="center">
    <h2>登录视图</h2>  <h4><a href="{{url('user/login')}}">注册</a></h4>
    <br>    <form action="{{url('user/log_do')}}" method="post" id="myform">
        @csrf
        <table>
            用户名：<input type="text" name="name"> <br>
            密码：<input type="password" name="pwd"> <br>
            <input type="submit" value="登录">
        </table>
    </form>
</div>
</body>
</html>
<script>
    $(function(){
        $('#myform').submit(function(){
            var data=$('#myform').serialize();
            console.log(data);
            $.post("{{url('user/log_do')}}",data,function(res){
                console.log(res.msg);
                alert(res.msg);
                if(res.code==1){
                    location.href="{{url('curl/index')}}";
                }
            },'json');

            return false;
        });

    })
</script>
