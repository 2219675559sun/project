@extends('App.admin.layouts')

@section('title', '货品列表')

@section('body')
    @parent
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>编号</th>
            <th>商品名称</th>
            <th>属性</th>
            <th>货号</th>
            <th>库存</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v['car_id']}}</td>
            <td>{{$v['g_name']}}</td>
            <td>{{$v['attr_id']}}</td>
            <td>{{$v['goods_num']}}</td>
            <td>{{$v['number']}}</td>
            <td>{{date('Y-m-d H:i:s',$v['create_time'])}}</td>
            <td>
                <a href="">编辑</a>&nbsp&nbsp
                <a href="">移除</a>
            </td>
        </tr>
            @endforeach
    </table>
</div>
@endsection

@section('script')

@endsection
