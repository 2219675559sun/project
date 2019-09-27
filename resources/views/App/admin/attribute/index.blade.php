@extends('App.admin.layouts')

@section('title', '商品属性列表')

@section('body')
    @parent
    <div class="container">
        <div class="row" style="color:#b6b6b6">
            <div class="col-md-4"><h1 style="color:#B1D2EC">商品属性</h1></div>
            <div class="col-md-4 col-md-offset-4"><a href="{{url('admin/attribute/add')}}?id={{$id}}"><h2>添加属性</h2></a></div>
        </div>
        <span style="size:100px;">按商品类型显示:</span> <select style="width:200px;height:30px;" name="t_pid" class="select">
            <option click="tid" value="0">--全部类型--</option>
{{--            <option click="tid" value="">--全部类型--</option>--}}
           @foreach($type as $v)
               @if($v['t_id']==$id)
            <option value="{{$v['t_id']}}" selected>{{$v['t_name']}}</option>
                @else
                    <option click="tid" value="{{$v['t_id']}}">{{$v['t_name']}}</option>
            @endif
                    @endforeach
        </select>
        <table class="table table-bordered">
            <tr>
                <th>
                    <input type="checkbox" id="checkbox">编号
                </th>
                <th>属性名称</th>
                <th>商品类型</th>
                <th>操作</th>
            </tr>
            <tbody id="list">
            @foreach($attribute as $v)
                <tr>
                    <td>
                        <input type="checkbox" name="checkboxs[]" value="{{$v['a_id']}}">{{$v['a_id']}}
                    </td>
                    <td>{{$v['a_name']}}</td>
                    <td>{{$v['t_name']}}</td>
                    <td>
                        <a href="">编辑</a>
                        <a href="">移除</a>
                    </td>
                </tr>
                @endforeach
            <tr><td>
                    <button class="button">批删</button>
                </td>
                <td colspan="8">{{ $attribute->links() }}</td>
            </tr>
            </tbody>
        </table>
        <div align="center" class="page"></div>
    </div>
@endsection

@section('script')
    <script>
        //查询
      $(function(){
          $(document).on('change','.select',function(){
              var id=$(this).val();
             $.get("{{url('admin/attribute/index_do')}}",{id:id},function(res){
                 mylist(res);

             },'json')
          });
          // 点击切换分页
          $(document).on('click','.page a',function(){
              var pag=$(this).attr('page');
              var id=$("[name='t_pid']").val();

              $.ajax({
                  type: "get",
                  url: '{{url("admin/attribute/index_do")}}',
                  data:{page:pag,id:id},
                  dataType: 'json',
                  success: function(res){
                      // console.log(res);
                      mylist(res);
                  }
              });
          });
            //分装
          function mylist(res){
              //展示分页
              $('#list').empty();
              var page="";
              for(i=1;i<=res.msg.last_page;i++){
                  // alert(res.msg.current_page);
                  if(res.msg.current_page==i){
                      page+="<ul class='pagination' role='navigation'><li class='page-item disabled page' aria-disabled='true'><a href='javascript:;' style='color:red;' page='"+i+"'>"+i+"</a></li></ul>";
                  }else{
                      page+="<ul class='pagination' role='navigation'><li class='page-item disabled page' aria-disabled='true'><a href='javascript:;' page='"+i+"'>"+i+"</a></li></ul>";
                  }
              }//循环数据
              $.each(res.msg.data,function(i,v){
                  var tr=$("<tr></tr>");
                  tr.append('<td><input type="checkbox" name="checkboxs[]" value="'+v.a_id+'">'+v.a_id+'</td>');
                  tr.append('<td>'+v.a_name+'</td>');
                  tr.append('<td>'+v.t_name+'</td>');
                  tr.append('<td><a href="">编辑</a>&nbsp&nbsp&nbsp<a href="">移除</a></td>');
                  $('#list').append(tr);
              });
              $('#list').append('<tr><td>\n' +
                  '                    <button class="button">批删</button>\n' +
                  '                </td>' +
                  '<td colspan="8" align="center">'+page+'</td>' +
                  '</tr>');

              // $('.page').html();
          }

          //全选反选
          $(document).on('click','#checkbox',function(){

              var che=$(this).prop('checked');
              $('[name="checkboxs[]"]').prop('checked',che);
          });
          //批删
          $(document).on('click','.button',function(){
              var ids ='';
              $('[name="checkboxs[]"]').each(function(){
                  if(this.checked == true){
                      ids += this.value + ',';
                  }
              });
              // alert(ids);return;
              $.ajax({
                  url:"{{url('admin/attribute/delete')}}",
                  type:'get',
                  data:{id:ids},
                  dataType:'json',
                  success: function(res){
                      if(res.code==200){
                          window.location.reload();
                      }else{
                          alert(res.msg);
                      }
                  }
              })
          });
      });
    </script>

@endsection
