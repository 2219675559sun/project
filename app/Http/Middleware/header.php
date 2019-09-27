<?php

namespace App\Http\Middleware;

use Closure;

class header
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
        //跨域问题
        //    *等价于所有
        // 制定允许其他域名访问
        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        //请求头
        header('Access-Control-Allow-Headers:*');
        // 响应头设置
        header('Access-Control-Allow-Credentials:false');
        //=------------------------
        //    *等价于所有
        // 制定允许其他域名访问
//        echo 1;die;
//        header('Access-Control-Allow-Origin:*');
//        // 响应类型
//        header('Access-Control-Allow-Methods:*');
//        //请求头
//        header('Access-Control-Allow-Headers:*');
//        // 响应头设置
//        header('Access-Control-Allow-Credentials:false');
//        //数据类型
//        header('content-type:application:json;charset=utf8');
//        header("content-type:text/html;charset=utf-8");  //设置编码

        $ip=$_SERVER['REMOTE_ADDR'];//获取消息头的ip
        $redis=new \Redis;
        $redis->connect('127.0.0.1','6379');
        $time=time();
        /*
         * 判断redis是否有值，如果没有从新设置，否则如果访问次数大于20次终止代码
         */
        if($redis->get("time".$ip)==false){
            $redis->set('time'.$ip,$time,60);
            $redis->del("ip".$ip);
        }else{
            $redis->incr("ip".$ip);
            if($redis->get("ip".$ip)>20){
                echo json_encode(['code'=>400,'msg'=>'系统繁忙，请稍后再试']);die;
            }
        }
        return $next($request);
    }
}
