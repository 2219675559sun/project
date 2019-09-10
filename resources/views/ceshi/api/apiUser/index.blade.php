@extends('ceshi/layout')

@section('title', '展示')

@section('body')
    <div class="container">
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>用户名</td>
            <td>头像</td>
            <td>注册时间</td>
            <td>修改时间</td>
            <td>操作</td>
        </tr>

        <tbody class="list">

        </tbody>
    </table>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $url="http://www.project.com/apiuser";
        $.ajax({
            url:$url,
            type:'get',
            dataType:'json',
            success: function(res){
        $.each(res.msg,function(i,v){
            var tr=$('<tr></tr>');
            tr.append("<td>"+v.id+"</td>");
            tr.append("<td>"+v.name+"</td>");
            tr.append("<td><img src=http://www.project.com/userapi/index/storage/"+v.image+" width='80' height='80'></td>");
            tr.append("<td>"+v.create_time+"</td>");
            tr.append("<td>"+v.update_time+"</td>");
            tr.append("<td><a href='javascript:;'>删除</a>&nbsp&nbsp<a href='javascript:;'>修改</a></td>");
            $('.list').append(tr);
        });

            }
        })
    </script>
@endsection
