<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/jquery.js"></script>
    <title>添加</title>
</head>
<body>
<div align="center">
        <h3>添加用户</h3>
    <table>
        姓名：<input type="text" name="name"><br>
        年龄：<input type="text" name="age"><br>
        性别：<input type="radio" name="sex" value="1" checked>男
                <input type="radio" name="sex" value="2">女
        <br>
        <input type="button" value="添加" class="button">
    </table>
</div>
</body>
</html>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(function(){
       $('.button').click(function(){
           var name=$("[name='name']").val();
           var age=$("[name='age']").val();
               var sex=$("input[type='radio']:checked").val();
               // alert(sex);
           var data={name:name,age:age,sex:sex};
           var url="http://www.project.com/api/user";
           $.ajax({
                 type: "POST",
                 url: url,
                 data: data,
                 dataType: 'json',
               success: function(res){
                     alert(res.msg);
                     if(res.code==200){
                         location.href="{{url('api/user/index')}}";
                     }
               }
            });

        })
    });
</script>
