<?php

namespace App\Http\Middleware;

use App\Http\Model\App\index\Log;
use Closure;

class app_index_log
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data=$request->all()??'';
//        dd($data);
        if(empty($data['token'])){
            echo json_encode(['code'=>204,'msg'=>'请先登录']);die;
        }else{
            $res=Log::find(['token'=>$data['token']]);
            if($res){
                if(time()>$res['expixe_time']){
                    echo json_encode(['code'=>209,'msg'=>'请重新登录']);die;
                }
                $res->expixe_time=time()+7200;
                $res->save();
                $request->attributes->add(['user_id'=>$res['u_id']]);//添加参数
//               echo json_encode(['code'=>200,'msg'=>'登录成功']);die;
            }else{
                echo json_encode(['code'=>203,'msg'=>'参数不存在']);die;
            }
    }
        return $next($request);
  }
}
