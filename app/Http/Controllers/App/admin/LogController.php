<?php

namespace App\Http\Controllers\App\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LogController extends Controller
{
    public function log(){

        return view("App.admin.log.index");
    }
    public function log_do(Request $request){
        $data=$request->all();
        $where=[
            ['u_name','=',$data['u_name']],
            ['u_pwd','=',$data['u_pwd']],
        ];
        $res=DB::connection('appshop_mysql')->table('app_user')->where($where)->first();
       if($res){
           $request->session()->put('u_name',$data['u_name']);
           return redirect('admin/category/index');
       }else{
           return redirect('admin/log');
       }
    }
}
