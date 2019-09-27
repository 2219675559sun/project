<?php

namespace App\Http\Controllers\App\admin;

use App\Http\Model\App\admin\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\App\admin\Attribute;
class AttributeController extends Controller
{
    public function add(Request $request){
        $id=$request->all()['id']??'';
        $type=Type::index();
        return view("App.admin.attribute.add",['type'=>$type,'id'=>$id]);
    }
    public function add_do(Request $request){
        $data=$request->all();
        unset($data['_token']);
        $res=Attribute::add($data);
        if($res){
            return redirect("admin/attribute/index?id=".$data['t_pid']);
        }else{
            return redirect('admin/attribute/add');
        }


    }
    public function index(Request $request){
        $id=$request->all()['id']??'';
//        展示属性
        $type=Type::index();
        if(!empty($id)){
            $A_where=[
                ['t_pid','=',$id],
            ];
        }else{
            $A_where=[];
        }
        $attribute=Attribute::index($A_where);

        foreach($attribute as $k=>$v){
//            dump($v['t_pid']);
            $where=[
                ['t_id','=',$v->t_pid],
            ];
            $type_find=Type::find($where);
            $attribute[$k]['t_name']=$type_find['t_name'];
        }
//        $attribute=$attribute['data'];
        return view("App.admin.attribute.index",['type'=>$type,'attribute'=>$attribute,'id'=>$id]);
    }
    public function index_do(Request $request){
        $id=$request->all()['id']??'';
        if(!empty($id)){
            $A_where=[
                ['t_pid','=',$id],
            ];
        }else{
            $A_where=[];
        }
        $attribute=Attribute::index($A_where);
//        dd($attribute);
        echo json_encode(['code'=>200,'msg'=>$attribute]);
    }
    //删除
    public function delete(Request $request){
        $id=$request->all()['id'];
        $id=rtrim($id,',');
        $ids=explode(',',$id);
        foreach($ids as $k=>$v) {
//            dd($v);
            $where=[
                ['a_id','=',$v],
            ];
            $res=Attribute::del($where);
        }
        if($res){
            echo json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            echo json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }
}
