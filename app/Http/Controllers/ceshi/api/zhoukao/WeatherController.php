<?php

namespace App\Http\Controllers\ceshi\api\zhoukao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class WeatherController extends Controller
{
   public function log(){

       return view('ceshi.api.zoukao.weather.log');
   }
    public function login(Request $request){
            $data=$request->all();
            $res=DB::connection('test1_mysql')->table('weather_user')->where(['u_name'=>$data['u_name'],'u_pwd'=>$data['u_pwd']])->first();
            if(empty($res)){
                return json_encode(['code'=>205,'msg'=>'用户名或密码不正确']);
            }else{
                $token=md5($res->id.time());
                $res->token=$token;
                $res->expire_time=time()+600;
//                $res->save();
                $update=DB::connection('test1_mysql')->table('weather_user')->where('id',$res->id)->update([
                    'token'=>$token,
                    'expire_time'=>time()+600,
                ]);
                return json_encode(['code'=>200,'token'=>$token]);
            }
    }
    public function user_info(Request $request){
        $data=$request->all();
//        dd($data);
        if(isset($data['citynm'])){
            $citynm=$data["citynm"];
        }else{
            $citynm=1;
        }
        if(isset($data['user_info'])){
            $res=DB::connection('test1_mysql')->table('weather_user')->where(['token'=>$data['user_info']])->first();
            if(empty($res)){
                return json_encode(['code'=>207,'msg'=>'参数不正确']);
            }else{
                $url="http://www.api.k780.com:88";
                $weather=file_get_contents('http://api.k780.com:88/?app=weather.future&weaid='.$citynm.'&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json');
               $weather=json_decode($weather,1);
                if($weather['success']==0){
                    return json_encode(['code'=>202,'msg'=>'为查询到当前城市']);
                };
                    return json_encode(['code'=>200,'msg'=>$weather['result']]);
            }
            return json_encode(['code'=>207,'msg'=>'参数不正确']);
        }else{
            return json_encode(['code'=>206,'msg'=>'缺少参数']);
        }

    }
    public function unset_token(Request $request){
       $token=$request->input('token');
        DB::connection('test1_mysql')->table('weather_user')->where('token',$token)->update([
            'token'=>'',
            'expire_time'=>0,
        ]);
    }
}
