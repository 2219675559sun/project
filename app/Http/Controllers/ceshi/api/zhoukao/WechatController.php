<?php

namespace App\Http\Controllers\ceshi\api\zhoukao;

use App\Http\Model\Ceshi\api\YueWechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    //注册
    public function login(Request $request){
            $data=$request->all();
        $ip=$_SERVER['REMOTE_ADDR'];
        $data['ip']=$ip;
        $data['appid']=time();
        $appsecret=time().rand(100000000000,999999999999).time();
        $data['appsecret']=$appsecret;
       $res=YueWechat::insert($data);
       if($res){
           return json_encode(['code'=>200,'msg'=>'注册成功']);
       }else{
           return json_encode(['code'=>201,'msg'=>'注册失败']);

       }
    }
    public function log(Request $request){

        $data=$request->all();
        $res=YueWechat::where(['u_name'=>$data['u_name'],'u_pwd'=>$data['u_pwd']])->first();
    $redis=new \Redis;
    $redis->connect('127.0.0.1','6379');
    $redis->set('u_id',$res->u_id,7200);

        if($res){

            return json_encode(['code'=>200,'msg'=>'登录成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'登录失败']);

        }
    }
    public function index(Request $request){
        $data=$request->all();
        $redis=new \Redis;
        $redis->connect('127.0.0.1','6379');
//        dd($redis->get('u_id'));
        $res=YueWechat::where('u_id',$redis->get('u_id'))->first();
//        dd($res);
       return view('ceshi.api.zoukao.weixin.index',['res'=>$res]);

    }
    public function list(Request $request){
        $data=$request->all(11);
        dd($data);
    }
}
