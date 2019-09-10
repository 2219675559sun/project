@extends('ceshi/layout')

@section('title', '添加')

@section('body')
    <div class="container">

    <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">输入框</label>
            <div class="layui-col-md5">
                <input type="text" name="name" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码框</label>
            <div class="layui-col-md5">
                <input type="password" name="pwd" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">请选择文件</label>
            <div class="layui-col-md5">
                <input type="file" name="file" required  lay-verify="required" class="layui-input">
            </div>
        </div>



        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn button">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    </div>
@endsection

@section('script')
    @parent
    <script>
        layui.use('form', function(){
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click','.button',function(){
           var name=$("[name='name']").val();
           var pwd=$("[name='pwd']").val();
            var fi=new FormData;
            var file=$("[name='file']")[0].files[0];
            fi.append('name',name);
            fi.append('pwd',pwd);
            fi.append('file',file);
            $url="http://www.project.com/apiuser";
            $.ajax({
                url:$url,
                type:'post',
                data:fi,
                contentType:false,//ajax2.0可以不用设置请求头，但是jq帮我们自动设置了，这样的话需要我们自己取消掉
                processData:false,//取消帮我们格式化数据，是什么就是什么
                dataType: 'json',
                success:function(res){
                    alert(res.msg);
                   if(res.code==200){
                       location.href="/userapi/index";
                   }
                }
            });
                return false;
        });
    </script>

@endsection
