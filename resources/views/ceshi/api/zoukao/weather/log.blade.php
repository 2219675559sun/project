<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>登录</title>

<link rel="stylesheet" href="/log/css/style.css">

<body>

<div class="login-container">
    <h1>天气查询平台</h1>

    <div class="connect">
        <p>sc.chinaz.com</p>
    </div>

    <form action="" method="post" id="loginForm">
        <div>
            <input type="text" name="u_name" class="username" placeholder="用户名" autocomplete="off"/>
        </div>
        <div>
            <input type="password" name="u_pwd" class="password" placeholder="密码" oncontextmenu="return false" onpaste="return false" />
        </div>
        <button id="submit" type="submit">登 陆</button>
    </form>

    <a href="register.html">
        <button type="button" class="register-tis">还有没有账号？</button>
    </a>

</div>

<script src="/log/js/jquery.min.js"></script>
{{--<script src="/log/js/common.js"></script>--}}
<!--背景图片自动更换-->
{{--<script src="/log/js/supersized.3.2.7.min.js"></script>--}}
{{--<script src="/log/js/supersized-init.js"></script>--}}
<!--表单验证-->
<script src="/log/js/jquery.validate.min.js?var1.14.0"></script>

</body>
</html>
<script>
    $(function(){
        $('#submit').click(function(){
            var u_name=$('[name="u_name"]').val();
            var u_pwd=$('[name="u_pwd"]').val();
            $.post("{{url('weather/login')}}",{u_name:u_name,u_pwd:u_pwd},function(res){
                // console.log(res);
                if(res.code==200){
                    location.href="http://www.project.com/weather/index?user_info="+res.token+"";
                }else{
                    alert(res.msg);
                }
            },'json');

            return false;
        });
    })
</script>
