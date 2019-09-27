@extends('App.admin.layouts')

@section('title', '商品分类添加')

@section('body')
    @parent

    <form role="form" id="myform" class="form-horizontal m-t">
        <h3>分类添加</h3>
        <div class="form-group draggable">
            <label class="col-sm-3 control-label">分类名称：</label>
            <div class="col-sm-9">
                <input type="text" name="c_name" class="form-control" placeholder="请输入商品分类名称" style="width:400px;height:50px;">
                <span id="span" class="help-block m-b-none"></span>
            </div>
        </div>

        <div class="form-group draggable">
            <label class="col-sm-3 control-label">商品分类：</label>
            <div class="col-sm-9">
                <select class="form-control" name="pid" style="width:400px;height:50px;">
                    <option value="0">顶级分类</option>
                    @foreach($data as $v)
                    <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group draggable">
            <label class="col-sm-3 control-label">是否显示：
            </label>

            <div class="col-sm-9">
                <label class="radio-inline">
                    <input type="radio" name="is_show" checked="" value="1" id="optionsRadios1" name="optionsRadios">显示</label>
                <label class="radio-inline">
                    <input type="radio" name="is_show" value="2" id="optionsRadios2" name="optionsRadios">不显示</label>

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
            var fas=false;
           $('[name="c_name"]').blur(function(){
                 var name=$(this).val();
                var _this=$(this);
               _this.next('span').empty();
               if(name==''){
                   _this.next('span').append('分类名称不可为空'); return;
               }
                $.get("{{url('admin/category/first')}}",{name:name},function(res){
                    if(res.code==201){
                    _this.next('span').append(res.msg);
                    }else{
                        fas=true;
                    }
                },'json');
               return false;
           });

                $('#myform').submit(function () {
                    // if($('#span').text()==''){
                    if(fas==true) {
                    var data = $('#myform').serialize();
                    $.post("{{url('admin/category/add_do')}}", data, function (res) {
                        alert(res.msg);
                    }, 'json');
                    // }
                    }
                    return false;
                });
        });
    </script>
@endsection
