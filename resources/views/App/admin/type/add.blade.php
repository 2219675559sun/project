@extends('App.admin.layouts')

@section('title', '商品列表添加')

@section('body')
    @parent
    <form role="form" id="myform" class="form-horizontal m-t">
        <h3>类型添加</h3>
        <div class="form-group draggable">
            <label class="col-sm-3 control-label">类型名称：</label>
            <div class="col-sm-9">
                <input type="text" name="t_name" class="form-control" placeholder="请输入商品分类名称" style="width:400px;height:50px;">
                <span class="help-block m-b-none span" style="color:red;"></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group draggable">
            <div class="col-sm-12 col-sm-offset-3">
                <input type="submit" value="保存内容"  class="btn btn-primary">
                <button class="btn btn-white" type="submit">取消</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            $('#myform').submit(function(){
                var data=$('#myform').serialize();
                $.post("{{url('admin/type/add_do')}}",data,function(res){
                    if(res.code==205){
                        $('.span').empty();
                    $('.span').append(res.msg);
                    }else{
                        alert(res.msg);
                        window.location.reload();
                    }
                    // console.log(res);
                },'json');
                return false;
            });
        });
    </script>

    @endsection
