<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>登录</title>

<link rel="stylesheet" href="/log/css/style.css">

<body>

<div class="login-container">
	<h1>NB CLASS</h1>
	
	<div class="connect">
		<p>  123 </p>
	</div>
	
	<form action="{{url('admin/log_do')}}" method="post">
        @csrf
		<div>
			<input type="text" name="u_name" placeholder="用户名" autocomplete="off"/>
		</div>
		<div>
			<input type="password" name="u_pwd" placeholder="密码" oncontextmenu="return false" onpaste="return false" />
		</div>
        <input type="submit" class="submit" value="登 陆">
	</form>

	<a href="register.html">
		<button type="button" class="register-tis">还有没有账号？</button>
	</a>

</div>
{{--<script rel="stylesheet" src="/login/images"></script>--}}
<img src="/login/images" alt="">
<script src="/log/js/jquery.min.js"></script>
<script src="/log/js/common.js"></script>
{{--<!--背景图片自动更换-->--}}
<script src="/log/js/supersized.3.2.7.min.js"></script>
<script src="/log/js/supersized-init.js"></script>
{{--<!--表单验证-->--}}
<script src="/log/js/jquery.validate.min.js?var1.14.0"></script>

<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
</div>
</body>
</html>

