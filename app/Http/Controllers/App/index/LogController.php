<?php

namespace App\Http\Controllers\App\index;

use App\Http\Model\App\index\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function log_do(Request $request){
        $data=$request->all();
            $res=Log::find(['u_name'=>$data['u_name'],'u_pwd'=>$data['u_pwd']]);
            if(empty($res)){
                return json_encode(['code'=>202,'msg'=>'用户名或密码错误']);
            }else{
                $token=md5($res['u_id'].time());
                $res->token=$token;
                $res->expixe_time=time()+7200;
                $res->save();
                return json_encode(['code'=>200,'msg'=>'登录成功','token'=>$token]);
            }
    }
    public function user_info(Request $request){
        $data=$request->all();
            if(empty($data['token'])){
                return json_encode(['code'=>204,'msg'=>'请先登录']);
            }else{
                $res=Log::find(['token'=>$data['token']]);
                if($res){
                    if(time()>$res['expixe_time']){
                        return json_encode(['code'=>209,'msg'=>'请重新登录']);
                    }
                    $res->expixe_time=time()+7200;
                    $res->save();
                    return json_encode(['code'=>200,'msg'=>'登录成功']);
                }else{
                    return json_encode(['code'=>203,'msg'=>'登录失败']);
                }
            }




    }
}
