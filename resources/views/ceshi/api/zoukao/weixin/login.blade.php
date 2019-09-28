<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/jquery.js"></script>
    <title>注册</title>
</head>
<body>
        <div align="center">
            <h5>注册页面  <a href="{{url('wechat/log')}}">登录</a></h5>
            <form action="" id="myform">
            用户名：<input type="text" name="u_name"><br>
            密码：<input type="password" name="u_pwd"><br>
                <input type="submit" value="注册">
            </form>
        </div>
</body>
</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('#myform').submit(function(){
            var data=$('#myform').serialize();
            // console.log(data);
            var url="http://www.project.com/yuekao/login";
            $.ajax({
               url:url,
                type:'post',
                data:data,
                dataType:'json',
                success:function(res){
                   alert(res.msg);
                   if(res.code==200){
                       location.href="/wechat/log";
                   }
                }
            });
            return false;
        });

    })
</script>
