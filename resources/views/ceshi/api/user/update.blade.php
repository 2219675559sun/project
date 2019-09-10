<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/jquery.js"></script>
    <title>修改</title>
</head>
<body>
<div align="center">
    <h2>修改页面</h2>
    <table>
        姓名：<input type="text" name="name"><br>
        年龄：<input type="text" name="age"><br>
        性别：
        <input type="radio" name="sex" value="1" checked>男
        <input type="radio" name="sex" value="2">女
        <br>
        <input type="button" value="修改" class="button">
    </table>
</div>
</body>
</html>
<script>
    $(function(){
        //csrf
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $url="http://www.project.com/api/user";
        var id=getUrlParam('id');
        $.ajax({
            type: "get",
            url:$url+'/'+id,
            dataType: 'json',
            success: function(res){
                $("[name='name']").val(res.msg.name);
                $("[name='age']").val(res.msg.age);
                if(res.msg.sex==1){
                    $("input[name='sex']").get(0).checked = true;
                }else{
                    $("input[name='sex']").get(1).checked = true;
                }
            }
        });

        //获取url中的参数
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }
        //修改
        $('.button').click(function(){
            var name=$("[name='name']").val();
            var age=$("[name='age']").val();
            var sex=$("input[type='radio']:checked").val();
            var data={_method:'put',name:name,age:age,sex:sex,id:id};
            console.log(data);
            $.ajax({
                type: "POST",
                url: $url+'/'+id,
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

