@extends('App.admin.layouts')

@section('title', '商品类型列表')

@section('body')
    @parent
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>序号</th>
                <th>商品类型名称</th>
                <th>属性数</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            @foreach($data as $v)
                <tr>
                    <td>{{$v['t_id']}}</td>
                    <td>{{$v['t_name']}}</td>
                    <td>{{$v['count']}}</td>
                    <td>{{date('Y-m-d H:i:s',$v['create_time'])}}</td>
                    <td>
                        <a href="{{url('admin/attribute/index')}}?id={{$v['t_id']}}" class="btn btn-info">属性列表</a>&nbsp&nbsp
                        <a href="" class="btn btn-danger">删除</a>&nbsp&nbsp
                        <a href="" class="btn btn-warning">修改</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@section('script')

@endsection
