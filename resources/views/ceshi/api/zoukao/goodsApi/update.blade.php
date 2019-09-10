@extends('ceshi/layout')

@section('title', '修改')

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
                <input type="file" name="pic" class="layui-input">
                <span id="image"></span>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn button">修改</button>
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
        //获取url中的参数
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $url="http://www.project.com/goodsapi";
        var id=getUrlParam('id');
        $.ajax({
            type: "get",
            url:$url+'/'+id,
            dataType: 'json',
            success: function(res){
                console.log(res);
                $("[name='name']").val(res.msg.name);
                $("[name='price']").val(res.msg.price);
                $("#image").append("<img src='/storage/"+res.msg.pic+"'  width='100'>");

            }
        });
        //修改
        $(document).on('click','.button',function(){
            var name=$("[name='name']").val();
            var price=$("[name='price']").val();
            var fi=new FormData;
            var file=$("[name='pic']")[0].files[0];
            fi.append('name',name);
            fi.append('price',price);
            fi.append('file',file);
            fi.append('_method','put');
            $url="http://www.project.com/goodsapi";
            $.ajax({
                url:$url+'/'+id,
                type:'post',
                data:fi,
                contentType:false,//ajax2.0可以不用设置请求头，但是jq帮我们自动设置了，这样的话需要我们自己取消掉
                processData:false,//取消帮我们格式化数据，是什么就是什么
                dataType: 'json',
                success:function(res){
                    // console.log(res);
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
