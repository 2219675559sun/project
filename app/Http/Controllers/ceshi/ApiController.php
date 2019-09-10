<?php

namespace App\Http\Controllers\ceshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Ceshi\Wechat_openid;
use App\Http\Model\Ceshi\User;
use App\Http\Aes\Aes;
use App\Http\Rsa\Rsa;
class ApiController extends Controller
{
    /*
     * 添加
     *
     * */
    public function create(Request $request){
//        return 11;die;
        $data=$request->input();
//        dump($data);
//        die;
        if(empty($data['name']) || empty($data['age']) || empty($data['sex'])){
            return json_encode(['code'=>'201','msg'=>'字段不可为空']);die;
        }
        $res=User::insert([
            'name'=>$data['name'],
            'age'=>$data['age'],
            'sex'=>$data['sex'],
        ]);
        if($res){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'添加失败']);

        }
    }
    /*
     * 展示
     * */
    public function index(){
        //对称加密
        $my='12345678901234561234567890123456';
        $mw='hLlDHcFgKgfDJMNR8yWFVq3ZFRmKh1TXFbV0G/qFE+rtT98uUvbIYMxK+Du4/OJ8A1Eal28skNg6ie10w80Xc8IbBJRLtmavduUC5IkceDf/haoh56jPxgIBTbgBa0a9YRDb5FrDWyQdA8VWMqEJpSZ0Ck99CR5Uxu/zKUU5U+amdhjLrn8pVJ5nSYx4KF3s';

        $aes=new Aes('12345678901234561234567890123456');
        //加密
//        $encrypt = $aes->encrypt($mw);
//        dump("<p>");
        //解密
//        dd($encrypt);
//       $decrypt=$aes->decrypt($mw);
//        dd($decrypt);
        //----------------------------------------------------------------------------
        //非对称加密
        $privkey=file_get_contents('./Rsa/privkey.txt');
        $pubkey=file_get_contents('./Rsa/pubkey.txt');
        $Rsa = new Rsa();
        $Rsa->init($privkey, $pubkey,TRUE);
        //私钥加密示例
        $data="张衡是个王八蛋";
        $encode = $Rsa->priv_encode($data);
//        dd($encode);
        $ret = $Rsa->pub_decode($encode);
//        dd($ret);
        //公钥加密示例
        $encode = $Rsa->pub_encode($data);
        dd($encode);
        $ret = $Rsa->priv_decode($encode);
        dd($ret);
        //---------------------------------------------------------------------
//        $url="http://wym.yingge.fun/api/test/addUser";
//        $data=md5('1901'.'孙志国'.'23');
//        dd(file_get_contents($url.'?'.'name=孙志国&age=23&sign='.$data));
//        $res=User::list();
//        if($res){
//            return json_encode(['code'=>200,'msg'=>$res]);
//        }else{
//            return json_encode(['code'=>201,'msg'=>'请求出错，请联系管理员']);
//        }
    }
    /*
     * 删除
     * */
    public function delete(Request $request){
        $id=$request->all();
        $where=[
            ['id'=>$id],
        ];
        $res=User::Udelete($where);
        if($res){
            return json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }
    //查询一条
    public function find(Request $request){
        $id=$request->input();
        if(empty($id)){
            return json_encode(['code'=>201,'msg'=>'缺少参数']);die;
        }
        $where=[
            ['id'=>$id],
        ];
        $res=User::first($where);
        if($res){
            return json_encode(['code'=>200,'msg'=>$res]);
        }else{
            return json_encode(['code'=>201,'msg'=>'系统出错，请联系管理员']);
        }
    }
    //修改
    public function update(Request $request){
        $data=$request->all();
        if(empty($data['name']) || empty($data['age']) || empty($data['sex'])){
            return json_encode(['code'=>'201','msg'=>'字段不可为空']);die;
        }
        $res=User::where('id',$data['id'])->update([
            'name'=>$data['name'],
            'age'=>$data['age'],
            'sex'=>$data['sex'],
        ]);
        if($res){
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'修改失败']);

        }
    }
        public function aes(){
        $url="http://wym.yingge.fun/api/test/addUser";
        $one="fdjfdsfjakfjadii";
        $cs="name=孙志国&age=23&mobile=18888888888";
        $aes=new aes($one);
        $info=$aes->encrypt($cs);
        dd(file_get_contents($url.'?authstr='.$info));

    }
    public function adduser(Request $request){
        $data=$request->all();
        if(empty($data['user'])){
            echo json_encode(['code'=>205,'msg'=>'参数错误']);die;
        }
        dd($data);
        $aes=new aes('1314520612345258');
        $info=$aes->decrypt($data);
            dd($data);
        $name=substr($data['user'],5);
        $data['name']=$name;
        unset($data['user']);
        dd($data);
        $ss="adduser?user=name=123&age=55&sex=男";
        $aes=new aes('1314520612345258');
        $info=$aes->decrypt($data);
    }
    public function ceshi(){
        $url="http://sun.vizhiguo.com/api/adduser";
        $one="1314520612345258";
        $cs="name=孙志国&age=23&mobile=18888888888";
//        $aes=new aes($one);
//        $info=$aes->encrypt($cs);
        dd(file_get_contents($url));
    }



}
