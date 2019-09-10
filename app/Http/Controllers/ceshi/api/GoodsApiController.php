<?php

namespace App\Http\Controllers\ceshi\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Ceshi\api\goodsApi\GoodsApi;
use Illuminate\Support\Facades\Storage;
class GoodsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redis=new \Redis;
        $redis->connect('127.0.0.1','6379');
        $data=$request->input('name');
        $where=[];
        $where_price=[];
       if($data!==null){
           $where=[
               ['name','like',"%{$data}%"]
           ];
           $where_price=[
               ['price','like',"%$data%"],
           ];
           if(empty($redis->get('name'.$data))){
               $res=GoodsApi::list($where,$where_price);
           }else{
               $res=json_decode($redis->get('name'.$data),1);
           }
           //搜索5次 存入redis
           $num=$redis->incr('num'.$data);
           if($num>=5){
               $redis->set('name'.$data,json_encode($res),7200);
           }
       }else{
           $res=GoodsApi::list();
       }

        if($data!==null) {
            foreach ($res['data'] as $k => $v) {
                $res['data'][$k]['name'] = str_replace($data, '<b style="color:red">'.$data.'</b>', $v['name']);
                $res['data'][$k]['price'] = str_replace($data, '<b style="color:red">'.$data.'</b>', $v['price']);
            }
        }
       if($res){
           echo json_encode(['code'=>200,'msg'=>$res]);
       }else{
           echo json_encode(['code'=>203,'msg'=>'出现未知错误，请联系管理员']);
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        unset($data['file']);
        $file = $request->file('file');
        if(empty($file)){
            echo json_encode(['code'=>201,'msg'=>'请上传文件']);die;
        }else{
            $dk=date('Y-n-j');
            $path=$file->store('api/goods/'.$dk);
            $data['pic']=$path;
            $res=GoodsApi::add($data);
        }
        if($res){
            echo json_encode(['code'=>200,'msg'=>'添加成功']);die;
        }else{
            echo json_encode(['code'=>202,'msg'=>'添加失败']);die;

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
        $where=[
            ['id','=',$id],
        ];
        $res=GoodsApi::find($where);
        echo json_encode(['code'=>200,'msg'=>$res]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();
        unset($data['file']);
        unset($data['_method']);
//        dd($data);
        $file = $request->file('file');
        $where=[
            ['id','=',$id],
        ];
        if(empty($file)){
            $res=GoodsApi::gupdate($where,$data);
        }else{
            $find=GoodsApi::find($where);
            Storage::delete($find['pic']);
            $dk=date('Y-n-j');
            $path=$file->store('api/goods/'.$dk);
            $data['pic']=$path;
            $res=GoodsApi::gupdate($where,$data);
        }
        if($res){
            echo json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            echo json_encode(['code'=>205,'msg'=>'修改失败']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $where=[
            ['id','=',$id],
        ];
        $find=GoodsApi::find($where);
        Storage::delete($find['pic']);
        $res=GoodsApi::del($where);
        if($res){
            echo json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            echo json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }
}
