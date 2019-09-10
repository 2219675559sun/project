<?php

namespace App\Http\Controllers\ceshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CurlController extends Controller
{
    public function index(Request $request){
        $url="http://www.project.com/api/adduser";
        $one="1314520612345258";
        $cs="name=孙志国&age=23&mobile=18888888888";
//        $aes=new aes($one);
//        $info=$aes->encrypt($cs);
        dd(file_get_contents($url.'?user='.$cs));
    dd();
        $name=$request->all();
        $where=[];
        if(!empty($name['name'])){
            $where=[
                ['s_name','like',"%{$name['name']}%"],
            ];
            $s_name=$name['name'];
        }else{
            $s_name='';
        }
        $data=DB::connection('cheshi')->table('s_school')
            ->where($where)
            ->join('s_classinfo','s_school.c_id','=','s_classinfo.c_id')
            ->select('s_school.*','s_classinfo.c_name')
            ->orderby('s_id')
            ->paginate(3);
        return view('ceshi.curl.index',['data'=>$data,'name'=>$s_name]);
    }
    public function add(){
        $data=DB::connection('cheshi')->table('s_classinfo')->get();

        return view('ceshi.curl.add',['data'=>$data]);
    }
    public function add_do(Request $request){
        $arr=$request->all();
        dd($arr);
        $res=DB::connection('cheshi')->table('s_school')->insert([
            's_name'=>$arr['s_name'],
            's_age'=>$arr['s_age'],
            's_tel'=>$arr['s_tel'],
            'c_id'=>$arr['c_id'],
            'createtime'=>time(),
        ]);
       return redirect('curl/index');
    }
    public function delete(Request $request){
        $id=$request->all()['id'];
        $res=DB::connection('cheshi')->table('s_school')->where('s_id',$id)->delete();
        return redirect('curl/index');
    }
    public function update(Request $request){
        $id=$request->all()['id'];
        $data=DB::connection('cheshi')->table('s_school')->where('s_id',$id)->first();
        $res=DB::connection('cheshi')->table('s_classinfo')->get();
        return view('ceshi.curl.update',['data'=>$data,'res'=>$res]);
    }
    public function update_do(Request $request){
        $data=$request->all();
        $res=DB::connection('cheshi')->table('s_school')->where('s_id',$data['id'])->update([
            's_name'=>$data['s_name'],
            's_age'=>$data['s_age'],
            's_tel'=>$data['s_tel'],
            'c_id'=>$data['c_id'],
            'updatetime'=>time(),
        ]);
        if($res){
            return redirect('curl/index');
        }else{
            return redirect('curl/update');
        }
    }
}
