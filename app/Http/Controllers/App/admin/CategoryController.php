<?php

namespace App\Http\Controllers\App\admin;

use App\Http\Common\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\App\admin\Category;
class CategoryController extends Controller
{
    public $common;
    public function __construct(Common $common)
    {
        $this->common=$common;
    }

    public function add(){
            $data=Category::index();

        return view("App.admin.category.add",['data'=>$data]);
    }
    public function add_do(Request $request){
        $data=$request->all();
        $res=Category::add($data);
       if($res){
           echo json_encode(['code'=>200,'msg'=>'保存成功']);die;
       }else{
           echo json_encode(['code'=>205,'msg'=>'保存失败']);die;
       }

    }
    public function first(Request $request){
        $data=$request->all()['name'];
        $where=[
            ['c_name','=',$data],
        ];
        $name=Category::find($where);
        if(!empty($name)){
            echo json_encode(['code'=>201,'msg'=>'该分类名已存在']);die;
        }else{
            echo json_encode(['code'=>200]);die;
        }
    }
    public function index(){
        $data=Category::index();
        $res=$this->common->getInfo($data,0);
//        dd($res);
        return view("App.admin.category.index",['data'=>$res]);
    }
}
