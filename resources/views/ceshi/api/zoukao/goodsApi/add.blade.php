@extends('ceshi/layout')

@section('title', '添加')

@section('body')

    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">商品名称</label>
            <div class="layui-col-md5">
                <input type="text" name="name" required  lay-verify="required" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品价格</label>
            <div class="layui-col-md5">
                <input type="number" name="price" required  lay-verify="required" placeholder="请输入商品价格" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品图片</label>
            <div class="layui-col-md5">
                <input type="file" name="pic" required  lay-verify="required" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn button">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

@endsection

@section('script')
    @parent
        <script>
            layui.use('form', function(){
                var form = layui.form;
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click','.button',function(){
                var name=$("[name='name']").val();
                var price=$("[name='price']").val();

                var fi=new FormData;
                var file=$("[name='pic']")[0].files[0];
                fi.append('name',name);
                fi.append('price',price);
                fi.append('file',file);
                $url="http://www.project.com/goodsapi";
                $.ajax({
                    url:$url,
                    type:'post',
                    data:fi,
                    contentType:false,//ajax2.0可以不用设置请求头，但是jq帮我们自动设置了，这样的话需要我们自己取消掉
                    processData:false,//取消帮我们格式化数据，是什么就是什么
                    dataType: 'json',
                    success:function(res){
                      console.log(res);
                        alert(res.msg);
                        if(res.code==200){
                            location.href="/goods_api/index";
                        }
                    }
                });



                return false;
            });
        </script>
@endsection
