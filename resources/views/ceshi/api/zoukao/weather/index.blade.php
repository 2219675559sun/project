<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
    <link href="/app/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <script src="/jquery.js"></script>
</head>
<body>
<div class="container">
    <form action="">
        <input type="text" name="citynm" placeholder="请输入搜索地址"><button class="button">搜索</button>
    </form>
    <table class="table table-bordered">
        <tr>
        <td>日期</td>
        <td>星期</td>
        <td>address</td>
        <td>地址</td>
        <td>气温</td>
        <td>天气</td>
        <td>风向</td>
        <td>风力</td>
        </tr>

        <tbody id="list">

        </tbody>
    </table>

</div>
</body>
</html>
<script>
    $(function(){
        //获取url中的参数
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }

        var url="http://www.project.com/weather/user_info?user_info=";
        $.ajax({
            url:url+getUrlParam('user_info'),
            type:'get',
            dataType:'json',
            success:function(res){
                // console.log(res.msg);
                if(res.code==200) {
                    $.each(res.msg, function (i, v) {
                        var tr = $('<tr></tr>');
                        tr.append('<td>' + v.days + '</td>');
                        tr.append('<td>' + v.week + '</td>');
                        tr.append('<td>' + v.cityno + '</td>');
                        tr.append('<td>' + v.citynm + '</td>');
                        tr.append('<td>' + v.temperature + '</td>');
                        tr.append('<td>' + v.weather + '</td>');
                        tr.append('<td>' + v.wind + '</td>');
                        tr.append('<td>' + v.winp + '</td>');

                        $('#list').append(tr);
                    });
                }else{
                    alert(res.msg);
                }
            }
        });
        var user_info=getUrlParam('user_info');
        $('.button').click('.button',function(){
            var citynm=$('[name="citynm"]').val();
            $.ajax({
                url:url+getUrlParam('user_info'),
                data:{citynm:citynm},
                type:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);
                    $('#list').empty();
                    if(res.code==200) {
                        $.each(res.msg, function (i, v) {
                            var tr = $('<tr></tr>');
                            tr.append('<td>' + v.days + '</td>');
                            tr.append('<td>' + v.week + '</td>');
                            tr.append('<td>' + v.cityno + '</td>');
                            tr.append('<td>' + v.citynm + '</td>');
                            tr.append('<td>' + v.temperature + '</td>');
                            tr.append('<td>' + v.weather + '</td>');
                            tr.append('<td>' + v.wind + '</td>');
                            tr.append('<td>' + v.winp + '</td>');

                            $('#list').append(tr);
                        });
                    }else{
                        alert(res.msg);
                    }
                }
            })
            return false;
        })
    });
</script>
