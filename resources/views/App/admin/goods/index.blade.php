@extends('App.admin.layouts')

@section('title', '商品分类列表')

@section('body')
    @parent
    <div class="container">
        <form action="{{url('admin/goods/index')}}">
        <select name="cat_id" id="" style="width:150px;height:30px;">
            <option value="">所有分类</option>
            @foreach($category as $k=>$v)
                @if($cat_id==$v['c_id'])
                <option value="{{$v['c_id']}}" selected><?php echo str_repeat('&nbsp',$v['level']*2) ?>{{$v['c_name']}}</option>
                @else
                    <option value="{{$v['c_id']}}"><?php echo str_repeat('&nbsp&nbsp',$v['level']*3) ?>{{$v['c_name']}}</option>
                    @endif
                @endforeach
        </select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="text" name="mohu" placeholder="关键字搜索" value="{{$mohu}}" style="width:150px;height:30px;">&nbsp&nbsp&nbsp
            <input type="submit" value="搜索">
        </form>
        <table class="table table-bordered">
            <tr>
                <th>
                    <input type="checkbox" id="checkbox">
                    编号</th>
                <th>商品名称</th>
                <th>分类名称</th>
                <th>价格</th>
                <th>商品图片</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            @foreach($data as $v)
                <tr g_id="{{$v->g_id}}">
                    <td>
                        <input type="checkbox" name="checkboxs[]" value="{{$v->g_id}}">{{$v->g_id}}
                    </td>
                    <td fieid="g_name">
                        <span class="span">{{$v->g_name}}</span>
                        <input class="input" type="text" value="{{$v->g_name}}" style="display:none;">
                    </td>
                    <td>{{$v->car_name}}</td>
                    <td>{{$v->g_price}}</td>
                    <td><img src="{{asset('storage/'.$v->g_img)}}" alt="" width="50"></td>
                    <td>{{$v->create_time}}</td>
                    <td>
                        <a href="">编辑</a>&nbsp&nbsp&nbsp
                        <a href="">删除</a>
                    </td>
                </tr>
                @endforeach
            <tr>
                <td><button class="button">批删</button></td>
                <td colspan="8" align="center">{{ $data->links() }}</td>
            </tr>
        </table>
</div>
@endsection

@section('script')
    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //全选反选
           $(document).on('click','#checkbox',function(){

               var che=$(this).prop('checked');
               $('[name="checkboxs[]"]').prop('checked',che);
           });
        //批删
            $(document).on('click','.button',function(){
                var ids ='';
                $('[name="checkboxs[]"]').each(function(){
                    if(this.checked == true){
                        ids += this.value + ',';
                    }
                });
                // alert(ids);return;
                $.ajax({
                    url:"delete",
                    type:'get',
                    data:{id:ids},
                    dataType:'json',
                    success: function(res){
                if(res.code==200){
                    window.location.reload();
                }else{
                    alert(res.msg);
                }
                    }
                })
            });
            //即点即改
            $('.span').click(function(){
                // alert(11);
                var _this=$(this);
                _this.hide();
                _this.next('input').show();

            });
            $('.input').blur(function(){
                // alert(22);
                var _this=$(this);
                var value=_this.val();
                var fieid=_this.parent('td').attr('fieid');
                var g_id=_this.parent().parent().attr('g_id');
                // alert(cate_id);return;
                var data={value:value,fieid:fieid,g_id:g_id};
                // console.log(data);
                $.post("{{url('admin/goods/update')}}",data,function(res){
                    // console.log(res);return;
                    if(res.code==200){
                        _this.hide();
                        _this.prev('span').text(value).show();
                    }else{
                        alert(res.msg);
                    }
                },'json');
            });
        });
    </script>
@endsection
