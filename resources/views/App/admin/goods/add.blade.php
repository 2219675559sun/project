@extends('App.admin.layouts')

@section('title', '商品添加')

@section('body')
    {{--        富文本编辑器--}}
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('UEditor/utf8-php/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('UEditor/utf8-php/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    @parent
    <div class="container">
    <h3 align="center">商品添加</h3>
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="javascript:;" name='basic'>基本信息</a></li>
        <li role="presentation" ><a href="javascript:;" name='attr'>商品属性</a></li>
        <li role="presentation" ><a href="javascript:;" name='detail'>商品详情</a></li>
    </ul>
    <br>
    <form action='{{url('admin/goods/add_do')}}' method="post" enctype="multipart/form-data" id='form'>
                @csrf
        <div class='div_basic div_form'>
            <div class="form-group">
                <label for="exampleInputEmail1">商品名称</label>
                <input type="text" class="form-control" name='g_name'>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">商品分类</label>
                <select class="form-control" name='cat_id'>
                    @foreach($category as $v)
                    <option value='{{$v['c_id']}}'><?php echo str_repeat('&nbsp',$v['level']*2) ?>{{$v['c_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">商品货号</label>
                <input type="text" class="form-control" name='goods_num'>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">商品价钱</label>
                <input type="text" class="form-control" name='g_price'>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">商品图片</label>
                <input type="file" name='g_img'>
            </div>
        </div>
        <div class='div_detail div_form' style='display:none'>
            <div class="form-group">
                <label for="exampleInputFile">商品详情</label>
                <!-- 加载编辑器的容器 -->
                <script id="container" name="g_content" type="text/plain" style="height:400px;">

                 </script>
            </div>
        </div>


        <div class='div_attr div_form' style='display:none'>
            <div class="form-group">
                <label for="exampleInputEmail1">商品类型</label>
                <select class="form-control" id="select" name='a_id' >
                    <option value='0'>--请选择--</option>
                    @foreach($type as $v)
                        <option value='{{$v['t_id']}}'>{{$v['t_name']}}</option>
                    @endforeach

                </select>
            </div>
            <br>
            <table width="100%" id="attrTable" class='table table-bordered'>
                <tbody id="list">

                </tbody>
{{--                <tr>--}}
{{--                    <td>前置摄像头</td>--}}
{{--                    <td>--}}
{{--                        <input type="hidden" name="attr_id_list[]" value="211">--}}
{{--                        <input name="attr_value_list[]" type="text" value="" size="20">--}}
{{--                        <input type="hidden" name="attr_price_list[]" value="0">--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><a href="javascript:;">[+]</a>颜色</td>--}}
{{--                    <td>--}}
{{--                        <input type="hidden" name="attr_id_list[]" value="214">--}}
{{--                        <input name="attr_value_list[]" type="text" value="" size="20">--}}
{{--                        属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">--}}
{{--                    </td>--}}
{{--                </tr>--}}
            </table>
            <!-- <div class="form-group">
                    颜色:
                    <input type="text" name='attr_value_list[]'>
            </div> -->
            <!-- <div class="form-group" style='padding-left:26px'>
                <a href="javascript:;">[+]</a>内存:
                <input type="text" name='attr_value_list[]'>
                属性价格:<input type="text" name='attr_price_list[][]'>
            </div> -->

        </div>
        <input type="submit" class="btn btn-default" id='btn' value="添加">
    </form>
    </div>
@endsection

@section('script')

    <script type="text/javascript">

        //标签页 页面渲染
        $(".nav-tabs a").on("click",function(){
            $(this).parent().siblings('li').removeClass('active');
            $(this).parent().addClass('active');
            var name = $(this).attr('name');  // attr basic
            $(".div_form").hide();
            $(".div_"+name).show();  // $(".div_"+name)
        });
    </script>
    <script>
        $(function(){
            $('#select').change(function(){
                var id=$(this).val();
                $.get("{{url('admin/goods/ajax_add')}}",{id:id},function(res){
                    $('#list').empty();
                    // console.log(res.msg.data);return;
                    $.each(res.msg,function(i,v){
                        // console.log(v);return;
                        var tr=$("<tr></tr>");
                        if(v.attr==1){
                        tr.append('<td>'+v.a_name+'</td>\n' +
                            '<td>\n' +
                            '<input type="hidden" name="attr_id_list[]" value="'+v.a_id+'">\n' +
                            '<input name="attr_value_list[]" type="text" value="" size="20">\n' +
                            '<input type="hidden" name="attr_price_list[]" value="0">\n' +
                            '</td>');
                        }else{
                            tr.append('<td><a href="javascript:;" id="jiahao">[+]</a>'+v.a_name+'</td>\n' +
                                '<td>\n' +
                                '<input type="hidden" name="attr_id_list[]" value="'+v.a_id+'">\n' +
                                '<input name="attr_value_list[]" type="text" value="" size="20">\n' +
                                '属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">\n' +
                                '</td>');
                        }
                        $('#list').append(tr);
                    });
                    console.log(res);
                },'json');
                return false;
            });

        });
        $(document).on('click','#jiahao',function(){
            var value=$(this).html();
            if(value=='[+]'){
                var tr_cone=$(this).parent().parent().clone();
                $(this).parent().parent().after(tr_cone);
                $(this).parent().parent().next().find('a').html('[-]');
            }else{
                $(this).parent().parent().remove();
            }

        });
        </script>
@endsection
