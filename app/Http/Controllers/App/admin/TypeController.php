<?php

namespace App\Http\Controllers\App\admin;

use App\Http\Model\App\admin\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Http\Model\App\admin\Type;
class TypeController extends Controller
{
    public function add(){

        return view("App.admin.type.add");
    }
    public function add_do(Request $request){
        $data=$request->input();
        $where=[
            ['t_name','=',$data['t_name']],
        ];
        $name=Type::find($where);
        if(!empty($name)){
            echo json_encode(['code'=>205,'msg'=>'类型已存在']);die;
        }
        $res=Type::add($data);
        if($res){
            echo json_encode(['code'=>200,'msg'=>'添加成功']);die;
        }else{
            echo json_encode(['code'=>201,'msg'=>'添加失败']);die;
        }
        return view("App.admin.type.add");
    }
    public function index(){

            $data=Type::index();
            foreach($data as $k=>$v){
                $where=[
                    ['t_pid','=',$v['t_id']]
                ];
              $res=Attribute::c_get($where);
                $data[$k]['count']=count($res);
            }
//            dd($data);
        return view("App.admin.type.index",['data'=>$data]);
    }

}
