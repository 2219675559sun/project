<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改</title>
</head>
<body>
<div align="center">
    <h3>修改</h3>
    <form action="{{url('curl/update_do')}}" method="post">
        <input type="hidden" name="id" value="{{$data->s_id}}">
        @csrf
    姓名：<input type="text" name="s_name" value="{{$data->s_name}}"><br>
    年龄：<input type="number" name="s_age" value="{{$data->s_age}}"><br>
    电话：<input type="tel" name="s_tel" value="{{$data->s_tel}}"><br>
    班级：<select name="c_id" id="">
        @foreach($res as $v)
            @if($data->c_id==$v->c_id)
            <option value="{{$v->c_id}}" selected>{{$v->c_name}}</option>
            @else
           <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                @endif
        @endforeach
    </select>
    <br>
    <br>
    <input type="submit" value="修改">
    </form>
</div>
</body>
</html>
