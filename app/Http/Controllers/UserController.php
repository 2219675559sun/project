<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    public function log(){
//       dd($this->info('abcd'));
        return view('user.log');
    }

//    public function info($str){
//        $str=strrev($str);
//        return $str;
//    }


    public function log_do(Request $request){
            $data=$request->all();
        $res=DB::connection('project')->table('user')->where(['name'=>$data['name'],'pwd'=>md5($data['pwd'])])->first();

        if($res!=null && $res->error <= 5 ){
            $add_time=$res->add_time+3600;
//            dd(date('i',$add_time-time()));
                $time=date('i',$add_time-time());
                if($add_time>time()){
//                dd(2);
                    echo json_encode(['code'=>2,'msg'=>'账号已锁定，请'.($time).'分钟后登录']);  die;
                }else{
                    $res=DB::connection('project')->table('user')->where('id',$res->id)->update([
                        'error'=>0,
                        'add_time'=>0,
                    ]);

            $redis=new \Redis;
            $redis->connect('127.0.0.1',6379);
            $redis->set('name',$data['name']);
            $res3=DB::connection('project')->table('user')->where('id',$res['id'])->update([
                'error'=>0,
            ]);
            echo json_encode(['code'=>1,'msg'=>'登录成功']);  die;
            }
        }else{
            $res1=DB::connection('project')->table('user')->where('name',$data['name'])->first();
           if($res1==null){
               echo json_encode(['code'=>2,'msg'=>'该用户不存在']);  die;
           }else{
               $add_time=$res1->add_time+3600;
//            dd(date('i',$add_time-time()));
               if($add_time<time()){
                   $res=DB::connection('project')->table('user')->where('id',$res1->name)->update([
                       'error'=>0,
                       'add_time'=>0,
                   ]);
               }
               if($res1->error==5){
                     $add_time=$res1->add_time+3600;
//                   dd($time);
                    $time=date('i',$add_time-time());
                   echo json_encode(['code'=>2,'msg'=>'账号已锁定，请'.($time).'分钟后登录']);  die;
               }
              $error=$res1->error;
              $res2=DB::connection('project')->table('user')->where('name',$data['name'])->update([
                  'error'=>$error+1,
                  'add_time'=>time(),
              ]);
               echo json_encode(['code'=>2,'msg'=>'密码错误，您还有'.(4-$error).'次机会']);  die;

           }
        }
    }
    public function login(){

        return view('user.login');
    }
    public function login_do(Request $request){
        $data=$request->all();
        if(session('code')!=$data['code']){
            echo json_encode(['msg'=>'验证码有误，请重新输入']);  die;
        }
        if(time()>session('time')+120){
            echo json_encode(['msg'=>'验证码已失效，请重新获取']); die;
        }
        $res=DB::connection('project')->table('user')->insert([
            'name'=>$data['name'],
            'pwd'=>md5($data['pwd']),
            'code'=>$data['code'],
        ]);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'注册成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'注册失败']);
        }
    }
    public function code(Request $request){
        $rand=rand(1000,9999);
        $request->session()->put('code',$rand);
        $request->session()->put('time',time());
        if($rand){
            echo json_encode(['msg'=>'您的验证码是'.$rand.'请尽快输入，两分钟内有效']);
        }else{
            echo json_encode(['msg'=>'获取验证码失败，请稍后再试']);
        }

    }
    public function index(){
        $redis=new \Redis;
        $redis->connect('127.0.0.1',6379);
        echo '欢迎'.$redis->get('name').'登录';

    }
}
