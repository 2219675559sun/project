@extends('App.admin.layouts')

@section('title', '商品属性添加')

@section('body')
    @parent
<div class="container">
    <h3>添加属性</h3>
    <form class="form-horizontal" action="{{url('admin/attribute/add_do')}}" method="post">
        @csrf
        <div class="form-group">
            属性名称：
                <input type='text' name="a_name" placeholder="请填写属性名">
        </div>
        <div class="form-group">
        所属商品类型：<select name="t_pid" id="">
            @foreach($type as $v)
                @if($v['t_id']==$id)
                    <option value="{{$v['t_id']}}" selected>{{$v['t_name']}}</option>
                @else
                    <option value="{{$v['t_id']}}">{{$v['t_name']}}</option>
                @endif
            @endforeach
        </select>
        </div>
        <div class="form-group">
        属性是否可选: <input type="radio" name="attr" value="1" checked>不可选 &nbsp
                    <input type="radio" name="attr" value="2">可选
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')

@endsection
