<?php

namespace App\Http\Controllers\ceshi\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Ceshi\api\ApiUser;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=ApiUser::all();
       echo json_encode(['code'=>200,'msg'=>$res]);
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
        $data=$request->all();
        $pwd=md5($data['pwd']);
        $data['pwd']=$pwd;
        $file = $request->file('file');
        if(empty($file)){
            echo json_encode(['code'=>'202','msg'=>'请上传头象']);die;
        }else{
            $dk=date('Y-n-j');
            $path=$file->store('api/user/'.$dk);
            $data['image']=$path;
            unset($data['file']);
            $res=ApiUser::add($data);
        }
        if($res){
            echo json_encode(['code'=>'200','msg'=>'添加成功']);die;
        }else{
            echo json_encode(['code'=>'202','msg'=>'添加失败']);die;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *查询一条
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 11;
    }
}
