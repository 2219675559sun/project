@extends('ceshi/layout')

@section('title', '展示')

@section('body')
<div class="container" align="center">
    <h2>展示页面</h2>
    <form class="form-inline">
    <div class="form-group">
        <label for="inputPassword2" class="sr-only">Password</label>
        <input type="text" name="user" class="form-control" id="inputPassword2" placeholder="请输入关键字">
    </div>
    <button type="button" class="btn btn-default btn-info user">搜索</button>
    </form>
        <table class="table table-bordered table table-hover">
        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>年龄</th>
            <th>性别</th>
            <th>操作</th>
        </tr>
        <tbody class="list">
        </tbody>
    </table>
    <div class="page">
    </div>
</div>
@endsection

@section('script')
    @parent
    <script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //展示
    $url="http://www.project.com/api/user";
    $.ajax({
        type: "get",
        url: $url,
        data:'',
        dataType: 'json',
        success: function(res){
            mypage(res);
        //分页
            $(document).on('click','.page a',function(){
                    var pag=$(this).attr('page');
                var user=$("[name='user']").val();
                $.ajax({
                    type: "get",
                    url: $url,
                    data:{page:pag,name:user},
                    dataType: 'json',
                    success: function(res){
                        mypage(res);
                    }
                });
            });
        }
    });
    //搜索
    $(document).on('click','.user',function(){
        var user=$("[name='user']").val();
        $.ajax({
            type: "get",
            url: $url,
            data:{name:user},
            dataType: 'json',
            success: function(res){
               mypage(res);
                $('.text').GL({
                    ocolor:'red',   //设置关键词高亮颜色
                    oshuru:user   //设置要显示的关键词
                });
            }
        });
    });
    //封装
    function mypage(res){
        //清空之前的元素
        $('.list').empty();
        $.each(res.msg.data,function(i,v){
            console.log(v);
            var tr=$('<tr></tr>');
            tr.append("<td>"+v.id+"</td>");
            tr.append("<td class='text'>"+v.name+"</td>");
            tr.append("<td class='text'>"+v.age+"</td>");
            if(v.sex==1){
                tr.append("<td>"+"男"+"</td>");
            }else{
                tr.append("<td>"+"女"+"</td>");
            }
            tr.append("<td><a href='javascript:;' id="+v.id+" class='delete btn btn-default btn-danger'>删除</a>&nbsp &nbsp| &nbsp &nbsp<a href='javascript:;' id="+v.id+" class='update btn btn-default btn-warning'>修改</a></td>");
            $('.list').append(tr);
        });
        //分页
        var page="";
        for(i=1;i<=res.msg.last_page;i++){
            // alert(res.msg.current_page);
            if(res.msg.current_page==i){
                page+="<ul class='pagination' role='navigation'><li class='page-item disabled' aria-disabled='true'><a href='javascript:;' style='color:red;' page='"+i+"'>"+i+"</a></li></ul>";
            }else{
                page+="<ul class='pagination' role='navigation'><li class='page-item disabled' aria-disabled='true'><a href='javascript:;' page='"+i+"'>"+i+"</a></li></ul>";
            }
        }
        $('.page').html(page);
    }

    //删除
    $(document).on('click','.delete',function(){
        var id=$(this).attr('id');
        var _this=$(this);
        $url="http://www.project.com/api/user";
        $.ajax({
            type: "delete",
            url: $url+'/'+id,
            dataType: 'json',
            success: function(res){
                if(res.code==200){
                    // window.location.reload();
                    _this.parents('tr').remove();
                }else{
                    alert(res.msg);
                }
            }
        });
    });
    //修改
    $(document).on('click','.update',function(){
        var id=$(this).attr('id');
         location.href="{{url('api/user/update')}}?id="+id;
    })
    </script>
@endsection


