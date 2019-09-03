<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加</title>
</head>
<body>
<div align="center">
    <form action="{{url('curl/add_do')}}" method="post">
        @csrf
    <h3>添加</h3>
        姓名：<input type="text" name="s_name"><br>
        年龄：<input type="number" name="s_age"><br>
        电话：<input type="tel" name="s_tel"><br>
        班级：<select name="c_id" id="">
            @foreach($data as $v)
            <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                @endforeach
        </select>
    <br>
    <br>
    <input type="submit" value="添加">
    </form>
</div>
</body>
</html>
