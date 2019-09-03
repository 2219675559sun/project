<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
    <link rel="stylesheet" href="/page.css">
</head>
<body>
<div align="center">
    <h3>展示页面</h3>
    <form action="{{url('curl/index')}}">
        <input type="text" name="name" placeholder="输入要查询的姓名" value="{{$name}}"><input type="submit" name="搜索">
    </form>
    <table width="800" border="1">
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>年龄</th>
            <th>电话</th>
            <th>班级</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{$v->s_id}}</td>
                <td>{{$v->s_name}}</td>
                <td>{{$v->s_age}}</td>
                <td>{{$v->s_tel}}</td>
                <td>{{$v->c_name}}</td>
                <td>{{date('Y-m-d H:i:s', $v->createtime)}}</td>
                <td>
                    <a href="{{url('curl/update')}}?id={{$v->s_id}}">修改</a> &nbsp
                    <a href="{{url('curl/delete')}}?id={{$v->s_id}}">删除</a>
                </td>
            </tr>
            @endforeach
        <tr>
            <td colspan="8" align="center">{{ $data->appends(['name' => $name])->links() }}</td>
        </tr>
    </table>
</div>
</body>
</html>
