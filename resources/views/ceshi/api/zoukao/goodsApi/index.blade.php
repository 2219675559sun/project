@extends('ceshi/layout')

@section('title', '展示')

@section('body')
    <div align="center">
    <form class="form-inline">
        <div class="form-group">
            <label for="exampleInputName2">请输入关键字</label>
            <input type="text" class="form-control" id="name" placeholder="请输入关键字">
        </div>
        <button type="button" class="btn btn-default sousuo">搜索</button>
    </form>
    </div>
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>商品名称</th>
            <th>商品价格</th>
            <th>商品图片</th>
            <th>添加时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody id="list">
        </tbody>
        <tr>
            <td colspan="8" align="center" class="page"></td>
        </tr>
    </table>
@endsection

@section('script')
    @parent
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $url="http://www.project.com/goodsapi";
        $.ajax({
            url:$url,
            type:'get',
            data:'',
            dataType:'json',
            success: function(res){
                if(res.code==203){
                    alert(res.msg);
                }
                console.log(res.msg);
                list(res);

            }
        });
        //搜索
        $(document).on('click','.sousuo',function(){
            var name=$('#name').val();
            // alert(name);
            $url="http://www.project.com/goodsapi";
            $.ajax({
                url:$url,
                type:'get',
                data:{name:name},
                dataType:'json',
                success: function(res){
                    if(res.code==203){
                        alert(res.msg);
                    }
                    console.log(res);
                list(res);
                }
            });
            return false;
        });
        //封装
        function list(res){
           $('#list').empty();
                $.each(res.msg.data,function(i,v){
                    var tr=$("<tr></tr>");
                    tr.append("<td>"+v.id+"</td>");
                    tr.append("<td>"+v.name+"</td>");
                    tr.append("<td>"+v.price+"</td>");
                    tr.append("<td><img src='/storage/"+v.pic+"'></td>");
                    tr.append("<td>"+v.create_time+"</td>");
                    tr.append("<td>"+v.update_time+"</td>");
                    tr.append("<td><a href='javascript:;' goodsid='"+v.id+"' class='btn btn-danger delete'>删除</a>&nbsp&nbsp<a href='javascript:;' goodsid='"+v.id+"' class='btn btn-warning update'>修改</a></td>");
                    $('#list').append(tr);
                });
                //分页
                var pag='';
                for(i=1;i<=res.msg.last_page;i++){
                    if(res.msg.current_page==i){
                        pag+="<ul class='pagination'><li><a href='javascript:;' id='page' page='"+i+"' style='color:red'>"+i+"</a></li></ul>";
                    }else{
                    pag+="<ul class='pagination'><li><a href='javascript:;' id='page' page='"+i+"'>"+i+"</a></li></ul>";
                    }
                }
                console.log(pag);
            $('.page').html(pag);

        }
        //分页
        $(document).on('click','#page',function(){
            var page=$(this).attr('page');
            var name=$('#name').val();
            $.ajax({
                url:$url,
                type:'get',
                data:{name:name,page:page},
                dataType:'json',
                success: function(res){
                    if(res.code==203){
                        alert(res.msg);
                    }
                    // console.log(res);
                    list(res);
                }
            });
        });
        //删除
        $(document).on('click','.delete',function(){
            var id=$(this).attr('goodsid');
            var _this= $(this);
            $url="http://www.project.com/goodsapi";
            $.ajax({
                url:$url+'/'+id,
                type:'delete',
                data:'',
                dataType:'json',
                success:function(res){
                    if(res.code==200){
                        _this.parents('tr').remove();
                    }else{
                        alert(res.msg);
                    }
                }

            });
        });
        //修改
        $(document).on('click','.update',function(){
            var id=$(this).attr('goodsid');
            location.href="{{url('goods_api/update')}}?id="+id;
        })
    </script>
@endsection

