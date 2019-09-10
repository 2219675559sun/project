<?php

namespace App\Http\Controllers\ceshi\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Ceshi\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name=$request->input('name');
        $where=[];
        $where_age=[];
        if(!empty($name)){
            $where=[
                ['name','like',"%$name%"],
            ];
            $where_age=[
                ['age','like',"%$name%"],
            ];
        }

        $res=User::list($where,$where_age);
//       dd($name_res);
//        if(empty($re['data'])){
//            $res=User::list($where_age);
//        }else{
//            $res=User::list($where);
//        }
        if($res){
            return json_encode(['code'=>200,'msg'=>$res]);
        }else{
            return json_encode(['code'=>201,'msg'=>'请求出错，请联系管理员']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->input();
        if(empty($data['name']) || empty($data['age']) || empty($data['sex'])){
            return json_encode(['code'=>'201','msg'=>'字段不可为空']);die;
        }
        $res=User::insert([
            'name'=>$data['name'],
            'age'=>$data['age'],
            'sex'=>$data['sex'],
        ]);
        if($res){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'添加失败']);

        }
    }

    /**
     * Display the specified resource.
     * 查询单条
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(empty($id)){
            return json_encode(['code'=>201,'msg'=>'缺少参数']);die;
        }
        $where=[
            ['id','=',$id],
        ];
        $res=User::first($where);
        if($res){
            return json_encode(['code'=>200,'msg'=>$res]);
        }else{
            return json_encode(['code'=>201,'msg'=>'系统出错，请联系管理员']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();
        if(empty($data['name']) || empty($data['age']) || empty($data['sex'])){
            return json_encode(['code'=>'201','msg'=>'字段不可为空']);die;
        }
        $res=User::where('id',$id)->update([
            'name'=>$data['name'],
            'age'=>$data['age'],
            'sex'=>$data['sex'],
        ]);
        if($res){
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'修改失败']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $where=[
            ['id','=',$id],
        ];
        $res=User::Udelete($where);
        if($res){
            return json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }
}
