@extends('App.admin.layouts')

@section('title', '商品列表')

@section('body')
    @parent
    <div class="container">
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>分类名称</th>
            <th>是否展示</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr  cate_id="{{$v['c_id']}}" pid="{{$v['pid']}}" style="display:none;">
            <td>
                <?php echo str_repeat('▽',$v['level']*2) ?>
                    <a href="javascript:;" class="show">+</a>
            </td>
            <td><?php echo str_repeat('&nbsp&nbsp',$v['level']*3) ?>{{$v['c_name']}}</td>
            <td>{{$v['is_show']==1?'上架':'下架'}}</td>
            <td>
                <a href="" class="btn btn-danger">删除</a>&nbsp&nbsp
                <a href="" class="btn btn-warning">修改</a>
            </td>
        </tr>
            @endforeach
    </table>
    </div>
@endsection

@section('script')
    <script>
        $("tr[pid=0]").show();
        // 点击+
        $(document).on('click','.show',function(){
            // alert(1);
            var a=$(this).text();
            var cate_id=$(this).parents('tr').attr('cate_id');
            // console.log(cate_id);
            if(a=='+'){
                if($("tr[pid='"+cate_id+"']").length>0){
                    $("tr[pid='"+cate_id+"']").show();
                    $(this).text('-');
                }

            }else{
                $("tr[pid='"+cate_id+"']").hide();
                $(this).text('+');
            }


            return false;
        });
    </script>
@endsection
