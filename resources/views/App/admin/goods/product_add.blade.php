@extends('App.admin.layouts')

@section('title', '货品添加')

@section('body')
    @parent
    <div class="container">
    <h3>货品添加</h3>
        <form action="{{url('admin/goods/product_add_do')}}" method="post">
            @csrf
            <input type="hidden" name="g_id" value="{{$goods_id}}">
    <table width="100%" id="table_list" class='table table-bordered'>
        <tbody>
        <tr>
            <th colspan="20" scope="col">商品名称：{{$goods_name}}&nbsp;&nbsp;&nbsp;&nbsp;货号：ECS000075</th>
        </tr>

        <tr>
            <!-- start for specifications -->
           @foreach($attr_name as $k=>$v)
                <td scope="col"><div align="center"><strong>{{$v}}</strong></div></td>
            @endforeach
            <!-- end for specifications -->
            <td class="label_2">货号</td>
            <td class="label_2">库存</td>
            <td class="label_2">&nbsp;</td>
        </tr>

        <tr id="attr_row">
            <!-- start for specifications_value -->
            @foreach($info as $k=>$v)
            <td align="center" style="background-color: rgb(255, 255, 255);">
                <select name="attr_id[]">
                    <option value="0" selected="">请选择...</option>
                    @foreach($v as $key=>$val)
                    <option value="{{$val}}">{{$val}}</option>
                    @endforeach
                </select>
            </td>

        @endforeach

            <!-- end for specifications_value -->
            <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="goods_num[]" value="" size="20"></td>
            <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="number[]" value="1" size="10"></td>
            <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button" value=" + " ></td>
        </tr>

        <tr>
            <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
                <input type="submit" value=" 保存">
            </td>
        </tr>
        </tbody>
    </table>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $(document).on('click','.button',function(){
                var value=$(this).val();
                if(value== ' + '){
                    var tr_cone=$(this).parent().parent().clone();
                    $(this).parent().parent().after(tr_cone);
                    $(this).parent().parent().next().find('[type="button"]').val(' - ');
                }else{
                    $(this).parent().parent().remove();
                }

            });
        });
    </script>
@endsection
